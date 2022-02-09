<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function makePayment(Request $request)
    {
        $this->paymentService
             ->computeTotAmount();

        return view('welcome', [
            'totalAmount' => $this->paymentService->totalAmount,
            'price' => $this->paymentService->price,
            'fee' => $this->paymentService->fee,
            ]);
    }


}
