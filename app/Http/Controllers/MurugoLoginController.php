<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RwandaBuild\MurugoAuth\Facades\MurugoAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MurugoLoginController extends Controller
{
    
    public function redirectToMurugo()
    {
        return MurugoAuth::redirect();
    }

    public function murugoCallback()
    { 
        $murugoUser = MurugoAuth::user();
        $user = $murugoUser->user;
        if(!$user){
            $user = User::create([
                'name' => $murugoUser->name,
                'murugo_user_id' => $murugoUser->id,
            ]);
             
            $user->attachRole('administrator');
        }
        Auth::login($user);
        return redirect()->route('payment');
    }
}
