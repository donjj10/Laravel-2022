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

    public function index(Request $request)
    {
        $this->paymentService
             ->computeTotalAmount();

        dd([
            'total_amount' => $this->paymentService->totalAmount,
            'initial_price' => $this->paymentService->price,
            'fee' => $this->paymentService->fee,
            'discount' => $this->paymentService->discount,
            ]);
    }
}
