<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Discount;

class PaymentService
{

    public $totalAmount;
    public $price;
    public $fee;
    public $discount;
    public $vat;
    public $coupon;
    public  LoyaltyService $loyltyService;

    public function __construct(){
        $this->price = Product::where('id',1)->pluck('price')->first(); 
        $this->coupon = Discount::where('name', 'coupon')->pluck('value')->first();
        $this->discount = Discount::where('name', 'discount')->pluck('value')->first();
        $this->fee = config('services.checkout.fee');
        $this->vat =config('services.checkout.vat');
        
    }
    /**
     * Computing the total amout to be paid
     */
    public function computeTotalAmount()
    {
        $this->discountAmount()
             ->feeCharge()
            ->vatAmount();
        
        $this->loyaltyService = new LoyaltyService($this->totalAmount);
        $this->loyaltyService
             ->loyaltyAmount();
          
            
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
        dd($this);
        return $this;
    }
}