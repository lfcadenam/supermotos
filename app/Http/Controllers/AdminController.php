<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MotoDisponible;
use App\Models\CarritoProducto;
use App\Models\Usuario;
use App\Models\Accesorio;
use App\Services\ProductService;
use App\Services\MotoService;

class AdminController extends Controller
{
    protected $productService;
    protected $motoService;

    public function __construct(ProductService $productService, MotoService $motoService)
    {
        $this->productService = $productService;
        $this->motoService = $motoService;
    }

    public function index()
    {
        $stats = [
            'motos_activas' => MotoDisponible::where('estado', 1)->count(),
            'motos_pendientes' => MotoDisponible::where('estado', 0)->count(),
            'pedidos_hoy' => CarritoProducto::whereDate('fch_registro', today())->count(),
            'usuarios' => Usuario::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function motos()
    {
        $motos = MotoDisponible::orderBy('id_moto_disp', 'desc')->paginate(15);
        return view('admin.motos', compact('motos'));
    }

    public function orders()
    {
        $orders = CarritoProducto::orderBy('id_carrito_pro', 'desc')->paginate(10);
        $pendingMotos = MotoDisponible::where('estado', 0)->orderBy('id_moto_disp', 'desc')->get();
        
        return view('admin.orders', compact('orders', 'pendingMotos'));
    }

    public function accessories()
    {
        $accessories = Accesorio::orderBy('id_accesorio', 'desc')->paginate(15);
        return view('admin.accessories.index', compact('accessories'));
    }

    public function createAccessory()
    {
        return view('admin.accessories.create');
    }

    public function storeAccessory(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:200',
            'valor' => 'required|numeric',
            'descripcion' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $name = md5(uniqid()) . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('fotos_motos'), $name);
            $data['fotos'] = $name;
        }

        $this->productService->createAccessory([
            'nombre_acc' => $data['nombre'],
            'valor' => $data['valor'],
            'descripcion' => $data['descripcion'],
            'fotos' => $data['fotos'] ?? null
        ]);

        return redirect()->route('admin.accessories')->with('success', 'Accesorio creado exitosamente.');
    }

    public function createMoto()
    {
        return view('admin.motos.create');
    }

    public function storeMoto(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:200',
            'marca' => 'required|string',
            'tipoMoto' => 'required|string',
            'linea' => 'required|string',
            'modelo' => 'required|integer',
            'kilometraje' => 'required|string',
            'ciudad' => 'required|string',
            'soat_tecno_matri' => 'required|string',
            'descripcion' => 'required|string',
            'valor' => 'required|numeric',
            'url_insta' => 'nullable|string',
            'moto_inv_ext' => 'required|integer',
            'archivo' => 'required|array',
            'archivo.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageNames = [];
        if ($request->hasFile('archivo')) {
            foreach ($request->file('archivo') as $image) {
                $name = md5(uniqid()) . '_' . $request->marca . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('fotos_motos'), $name);
                $imageNames[] = $name;
            }
        }

        $this->motoService->create([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'tipoMoto' => $request->tipoMoto,
            'linea' => $request->linea,
            'modelo' => $request->modelo,
            'kilometraje' => $request->kilometraje,
            'ciudad_clie_moto' => $request->ciudad, // En el admin se usa ciudad
            'soat_tecno_matri' => $request->soat_tecno_matri,
            'descripcion' => $request->descripcion,
            'valor' => $request->valor,
            'url_insta' => $request->url_insta,
            'fotos' => implode(',', $imageNames),
            'moto_inv_ext' => $request->moto_inv_ext,
            'estado' => 1, // Activa por defecto si la crea el admin
        ]);

        return redirect()->route('admin.motos')->with('success', 'Moto registrada exitosamente.');
    }

    public function activateMoto($id)
    {
        $moto = MotoDisponible::findOrFail($id);
        $moto->estado = 1;
        $moto->save();

        return redirect()->back()->with('success', 'Publicación activada exitosamente.');
    }

    public function preview($id)
    {
        $moto = MotoDisponible::findOrFail($id);
        return view('admin.partials.moto_preview', compact('moto'));
    }
}
