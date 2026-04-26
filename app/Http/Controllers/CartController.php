<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $items = $this->cartService->getItemsInCart();
        return view('cart.index', compact('items'));
    }

    public function store(Request $request)
    {
        $this->cartService->addProduct(
            $request->id_producto,
            $request->cantidad,
            $request->referenceCode,
            $request->usuario
        );

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito');
    }

    public function updateCustomer(Request $request, $idCarrito)
    {
        $this->cartService->updateCustomerInfo($idCarrito, $request->all());
        return redirect()->back()->with('success', 'Información actualizada');
    }
}
