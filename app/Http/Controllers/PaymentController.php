<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\MotoService;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    protected $motoService;

    public function __construct(MotoService $motoService)
    {
        $this->motoService = $motoService;
    }

    public function response(Request $request)
    {
        $boldOrderId = $request->query('bold-order-id');
        
        if (!$boldOrderId) {
            return redirect()->route('home')->with('error', 'ID de orden no encontrado.');
        }

        // Llamada a la API de Bold para verificar estado
        $response = Http::withHeaders([
            'Authorization' => 'x-api-key 6QAZfgIh9hgrXu1ssTEDLOiuaqwG68pXfC0PnS8Qjbg'
        ])->get("https://payments.api.bold.co/v2/payment-voucher/{$boldOrderId}");

        if ($response->successful()) {
            $data = $response->json();
            $status = $data['payment_status'];
            
            // Extraer ID de la moto del bold-order-id (formato: "moto_{id}")
            $motoId = substr($boldOrderId, strpos($boldOrderId, "_") + 1);

            if ($status === 'APPROVED') {
                $this->motoService->activate($motoId);
                $moto = $this->motoService->getById($motoId);
                
                // Enviar correo si existe
                if ($moto && $moto->correo_clie_moto) {
                    $link = route('motos.show', md5($moto->id_moto_disp));
                    $this->motoService->notifyPublication($moto->correo_clie_moto, $link);
                }

                return view('payment.response', [
                    'status' => 'approved',
                    'moto' => $moto
                ]);
            } else {
                $this->motoService->deactivate($motoId);
                return view('payment.response', ['status' => 'rejected']);
            }
        }

        return redirect()->route('home')->with('error', 'Error al verificar el pago con Bold.');
    }
}
