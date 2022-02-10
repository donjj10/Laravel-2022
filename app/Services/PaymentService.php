<?php

namespace App\Services;

class PaymentService
{

    public $totalAmount;
    public $price;
    public $fee;
    public $discount;
    public $vat;
    public $coupon;

    public function __construct(){
        $this->price = config('products.price');
        $this->discount = true;
        $this->fee = 100;
        $this->vat =0.18;
        $this->coupon = 0.2;
    }
    /**
     * Computing the total amout to be paid
     */
    public function computeTotalAmount()
    {
        $this->discountAmount()
             ->feeCharge()
            ->vatAmount();
        
            return $this;
    }
    /**
     * applying discount of 20% to the intial price
     */
    public function discountAmount()
    {
        if($this->discount){
            
            $this->totalAmount = $this->price - ($this->price * $this->coupon);
        }

        return $this;
    }

    /**
     * function to apply a fee for the payment
     */
    public function feeCharge()
    {
        if($this->fee){
            $this->totalAmount += $this->fee;
        }

        return $this;
    }
    /**
     * applying VAT of 18% to the total amount
     */
    public function vatAmount()
    {
        if($this->vat){

            return $this->totalAmount += ($this->totalAmount * $this->vat);
        }
        
        return $this;
    }
}