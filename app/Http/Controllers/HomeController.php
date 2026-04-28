<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProductService;
use App\Services\MotoService;

class HomeController extends Controller
{
    protected $productService;
    protected $motoService;
    protected $parameterService;

    public function __construct(ProductService $productService, MotoService $motoService, \App\Services\ParameterService $parameterService)
    {
        $this->productService = $productService;
        $this->motoService = $motoService;
        $this->parameterService = $parameterService;
    }

    public function index(Request $request)
    {
        // Si venimos de Bold en localhost, los parámetros llegan a la raíz.
        // Redirigimos automáticamente a la página de respuesta.
        if ($request->has('bold-order-id')) {
            return redirect()->route('payment.response', $request->all());
        }

        $productos = $this->productService->getAllProducts();
        $motos = $this->motoService->getAllAvailable();
        $valorPublicacion = $this->parameterService->get('VALOR_PUBLICA_MOTO');

        return view('home', compact('productos', 'motos', 'valorPublicacion'));
    }

    public function accessories()
    {
        $accessories = $this->productService->getPublishedAccessories(12);

        return view('accessories.index', compact('accessories'));
    }
}
