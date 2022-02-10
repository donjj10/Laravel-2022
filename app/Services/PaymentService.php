<?php

namespace App\Services;

class PaymentService
{

    public $totalAmount;
    public $price;
    public $fee;
    public $vat;
    public $discount;

    public function __construct(){
        $this->price = config('products.price');
        $this->discount = true;
        $this->fee = 100;
    }

    public function computeTotAmount()
    {
        $this->discountAmount()
             ->feeCharge()
            ->vatAmount();
        
            return $this;
    }
    /**
     * discount 20%
     */
    public function discountAmount()
    {
        if($this->discount){
            
            $this->totalAmount = $this->price - ($this->price * 0.2);
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
    /**
     * VAT 18%
     */
    public function vatAmount()
    {
        
        return $this->totalAmount += ($this->totalAmount * 0.18);
        
        
    }
}