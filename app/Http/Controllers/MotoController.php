<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotoDisponible;
use App\Mail\MotoPublicada;
use App\Services\ParameterService;
use App\Services\MotoService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MotoController extends Controller
{
    protected $motoService;
    protected $parameterService;

    public function __construct(MotoService $motoService, ParameterService $parameterService)
    {
        $this->motoService = $motoService;
        $this->parameterService = $parameterService;
    }

    public function create()
    {
        $textoPublica = $this->parameterService->get('TEXTO_PUBLICA_MOTO');
        return view('motos.create', compact('textoPublica'));
    }

    public function index(Request $request)
    {
        $filters = $request->only(['query', 'location', 'status', 'marca', 'linea', 'per_page']);
        $motos = $this->motoService->getMotos($filters, 1); // 1 = Inventario RT

        return view('motos.index', compact('motos'));
    }

    public function colombia(Request $request)
    {
        $filters = $request->only(['query', 'location', 'status', 'marca', 'linea', 'per_page']);
        $motos = $this->motoService->getMotos($filters, null); // null = Todas las activas (RT + Externas)

        return view('motos.colombia', compact('motos'));
    }

    public function show($idMd5)
    {
        $moto = $this->motoService->getByIdMd5($idMd5);

        if (!$moto) {
            abort(404);
        }

        $relatedMotos = MotoDisponible::where('estado', 1)
            ->where('id_moto_disp', '!=', $moto->id_moto_disp)
            ->orderByRaw('CASE WHEN marca = ? THEN 0 ELSE 1 END', [$moto->marca])
            ->orderByDesc('id_moto_disp')
            ->limit(12)
            ->get();

        return view('motos.show', compact('moto', 'relatedMotos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buyerFullName' => 'required|string|max:100',
            'payerPhone' => 'required|string|max:15',
            'buyerEmail' => 'required|email|max:100',
            'billingCity' => 'required|string|max:100',
            'nombre' => 'required|string|max:200',
            'Marca' => 'required|string',
            'tipoMoto' => 'required|string',
            'linea' => 'required|string',
            'modelo' => 'required|integer',
            'kilometraje' => 'required|string',
            'soat-tecno-matricula' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'url' => 'nullable|string',
            'fotos_cars' => 'required|array',
            'fotos_cars.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'payment_method' => 'required|in:1,2'
        ]);

        DB::beginTransaction();

        try {
            $imageNames = [];
            if ($request->hasFile('fotos_cars')) {
                foreach ($request->file('fotos_cars') as $image) {
                    $name = md5(uniqid()) . '_' . $request->Marca . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('fotos_motos'), $name);
                    $imageNames[] = $name;
                }
            }

            $moto = $this->motoService->create([
                'nombre_clie_moto' => $request->buyerFullName,
                'telefono_clie_moto' => $request->payerPhone,
                'correo_clie_moto' => $request->buyerEmail,
                'ciudad_clie_moto' => $request->billingCity,
                'nombre' => $request->nombre,
                'marca' => $request->Marca,
                'tipoMoto' => $request->tipoMoto,
                'linea' => $request->linea,
                'modelo' => $request->modelo,
                'kilometraje' => $request->kilometraje,
                'soat_tecno_matri' => $request->input('soat-tecno-matricula'),
                'descripcion' => $request->descripcion,
                'valor' => $request->precio,
                'url_insta' => $request->url,
                'fotos' => implode(',', $imageNames),
                'moto_inv_ext' => 2, // Externo
                'estado' => 0, // Inactivo hasta pago
            ]);

            // Redirigir según medio de pago
            if ($request->payment_method == '1') {
                $valorPublicacion = $this->parameterService->get('VALOR_PUBLICA_MOTO');

                $referencia = 'moto_' . $moto->id_moto_disp;
                $valor = (int)$valorPublicacion;
                $currency = "COP";
                $secretKey = config('services.bold.secret_key');

                // Generar firma de integridad tal como indica la documentación
                $integritySignature = hash("sha256", $referencia . $valor . $currency . $secretKey);

                DB::commit();

                return redirect()->route('motos.create')->with([
                    'open_checkout' => true,
                    'checkout_data' => [
                        'orderId' => $referencia,
                        'amount' => $valor,
                        'apiKey' => config('services.bold.api_key'),
                        'integritySignature' => $integritySignature,
                        'description' => "Publicación de moto en la página de Supermotos",
                        'buyerEmail' => $moto->correo_clie_moto,
                        'buyerFullName' => $moto->nombre_clie_moto,
                        'payerPhone' => $moto->telefono_clie_moto,
                        'billingCity' => $moto->ciudad_clie_moto,
                        'redirectionUrl' => config('services.bold.redirection_url'),
                    ]
                ]);
            }

            DB::commit();

            // Notificar por correo (Solo para transferencia, en PSE se hace tras confirmar el pago)
            if ($moto->correo_clie_moto) {
                $link = route('motos.show', md5($moto->id_moto_disp));
                $this->motoService->notifyPublication($moto->correo_clie_moto, $link);
            }

            return redirect()->back()->with('success', 'Tu publicación ha sido creada exitosamente y está pendiente de activación por transferencia.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Excepción en MotoController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }
}
