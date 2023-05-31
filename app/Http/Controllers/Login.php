<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\delivery;
use App\Models\manager;
use App\Models\password_auth;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Login extends Controller
{

    public function store(Request $request)
    {
        try{
            $email=$request->input('email');
            $password=$request->input('password');
            $user=password_auth::find($email);
            $manager=manager::find($email);
            if($manager){
                if (Hash::check($password, $user->password)) {
                    return response()->json(['success'=>true,'user' => $user,'manager'=>$manager,'userType'=>'manager'], 200);
                } else {
                    return response()->json(['success'=>false], 200);
                }
            }   
            $customer=customer::find($email);
            if($customer){
                if (Hash::check($password, $user->password)) {
                    return response()->json(['success'=>true,'user' => $user,'customer'=>$customer,'userType'=>'customer'], 200);
                } else {
                    return response()->json(['success'=>false], 200);
                }
            }
            $delivery=delivery::find($email);
            if($delivery){
                if (Hash::check($password, $user->password)) {
                    return response()->json(['success'=>true,'user' => $user,'delivery'=>$delivery,'userType'=>'delivery'], 200);
                } else {
                    return response()->json(['success'=>false], 200);
                }
            }
            else{
                throw new Exception('user does not exist');
            }
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

}
