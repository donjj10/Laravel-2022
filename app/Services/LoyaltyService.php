<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\User;
use illuminate\Support\Facades\Auth;

class LoyaltyService{
    public $loyaltyPoints;
    public $loyaltyValue;
    public $user;
    public $totalAmount;

    public function __construct($totalAmount)
    {
        $this->loyaltyPoints = Auth::user()->loyalty_point;
        $this->loyaltyValue = Discount::where('name', 'loyalty')->pluck('value')->first();
        $this->user = Auth::user()->id;
        $this->totalAmount = $totalAmount;
    }

    public function loyaltyAmount()
    {

        if($this->totalAmount > 3000 && $this->loyaltyPoints >=10){
            $this->totalAmount -= $this->loyaltyValue; 
            $this->loyaltyPoints -=10;
            User::where('id',$this->user)->update(array('loyalty_point'=>$this->loyaltyPoints));
            return $this;
        }


        elseif($this->totalAmount > 3000){

            $this->loyaltyPoints +=1;
            User::where('id',$this->user)->update(array('loyalty_point'=>$this->loyaltyPoints));
            return $this;
            
        }
         
    }
}

