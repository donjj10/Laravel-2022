<?php

namespace App\Services;

class PaymentService
{

    public $totalAmount;
    public $price;
    public $fee;
    public $vat;
    public $coupon;

    public function __construct(){
        $this->price = config('products.price');
        $this->discount = config('products.coupon');
        $this->fee = 100;
        $this->vat = 18/100;
        $this->myCoupon = 20/100;
    }

    public function computeTotAmount()
    {
        $this->discountAmount()
             ->feeCharge()
            ->vatAmount();

        return $this;
    }

    public function discountAmount()
    {
        if($this->discount){
            $this->totalAmount = $this->price - ($this->price * $this->myCoupon);
        }

        return $this;
    }


    public function feeCharge()
    {
        if($this->fee){
            $this->totalAmount += $this->fee;
        }

        return $this;
    }

    public function vatAmount()
    {
        if($this->vat){
        
            $this->totalAmount += ($this->totalAmount * $this->vat);
        }

        return $this;
    }
}