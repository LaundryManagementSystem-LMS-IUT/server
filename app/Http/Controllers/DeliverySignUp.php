<?php

namespace App\Http\Controllers;

use App\Models\delivery;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeliverySignUp extends Controller
{
    public function update(Request $request,$email){
        try{
            delivery::where('email',$email)->update([
                'phone_number'=>$request->input('phone_number'),
            ]);
            user::where('email',$email)->update([
                'profile_picture'=>$request->input('profile_picture'),
            ]);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }
}
