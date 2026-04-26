<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MotoPublicada;
use App\Services\ParameterService;
use App\Services\MotoService;

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

        return view('motos.show', compact('moto'));
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
            'fotos_cars.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

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

        // Notificar por correo
        if ($moto->correo_clie_moto) {
            $link = route('motos.show', md5($moto->id_moto_disp));
            $this->motoService->notifyPublication($moto->correo_clie_moto, $link);
        }

        return redirect()->back()->with('success', 'Tu publicación ha sido creada exitosamente y está pendiente de activación.');
    }
}
