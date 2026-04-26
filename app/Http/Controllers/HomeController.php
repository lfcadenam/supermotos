<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProductService;
use App\Services\MotoService;

class HomeController extends Controller
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
        $productos = $this->productService->getAllProducts();
        $motos = $this->motoService->getAllAvailable();

        return view('home', compact('productos', 'motos'));
    }
}
