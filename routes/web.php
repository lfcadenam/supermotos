<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/accesorios', [HomeController::class, 'accessories'])->name('accessories.index');

// Motos
Route::get('/motos-colombia', [MotoController::class, 'colombia'])->name('motos.colombia');
Route::get('/motos/{id}', [MotoController::class, 'show'])->name('motos.show');
Route::post('/motos', [MotoController::class, 'store'])->name('motos.store');

// Carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito', [CartController::class, 'store'])->name('cart.store');
Route::post('/carrito/{id}/cliente', [CartController::class, 'updateCustomer'])->name('cart.updateCustomer');

// Pagos
Route::get('/pago/respuesta', [PaymentController::class, 'response'])->name('payment.response');

// Autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Estáticas (Legacy pages)
Route::view('/nosotros', 'pages.about')->name('pages.about');
Route::view('/contacto', 'pages.contact')->name('pages.contact');
Route::get('/publicar', [MotoController::class, 'create'])->name('motos.create');

// Admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/motos', [AdminController::class, 'motos'])->name('motos');
    Route::get('/motos/nueva', [AdminController::class, 'createMoto'])->name('motos.create');
    Route::post('/motos', [AdminController::class, 'storeMoto'])->name('motos.store');
    Route::get('/motos/{id}/editar', [AdminController::class, 'editMoto'])->name('motos.edit');
    Route::put('/motos/{id}', [AdminController::class, 'updateMoto'])->name('motos.update');
    Route::post('/motos/{id}/activar', [AdminController::class, 'activateMoto'])->name('motos.activate');
    Route::delete('/motos/{id}', [AdminController::class, 'deleteMoto'])->name('motos.delete');
    Route::get('/motos/{id}/preview', [AdminController::class, 'preview'])->name('motos.preview');
    Route::get('/pedidos', [AdminController::class, 'orders'])->name('orders');
    Route::get('/accesorios', [AdminController::class, 'accessories'])->name('accessories');
    Route::get('/accesorios/nuevo', [AdminController::class, 'createAccessory'])->name('accessories.create');
    Route::post('/accesorios', [AdminController::class, 'storeAccessory'])->name('accessories.store');
    Route::get('/accesorios/{id}/editar', [AdminController::class, 'editAccessory'])->name('accessories.edit');
    Route::put('/accesorios/{id}', [AdminController::class, 'updateAccessory'])->name('accessories.update');
});
