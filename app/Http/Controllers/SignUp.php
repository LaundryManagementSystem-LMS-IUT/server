<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\delivery;
use App\Models\manager;
use App\Models\password_auth;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SignUp extends Controller
{

    public function store(Request $request)
    {
        try{
            $user=user::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
            ]);
            $password_auth=password_auth::create([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            if($request->userType==='manager'){
                $manager=manager::create([
                    'email' => $request->input('email'),
                ]);
            }
            else if($request->userType==='customer'){
                $customer=customer::create([
                    'email' => $request->input('email'),
                ]);
            }
            else{
                $delivery=delivery::create([
                    'email' => $request->input('email'),
                ]);
            }
            return response()->json(['user' => $user,'auth'=>$password_auth,'userType'=>$request->userType], 200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        // Code for handling the "show" action
    }

    public function update(Request $request, $id)
    {
        // Code for handling the "update" action
    }

    public function destroy($id)
    {
        // Code for handling the "destroy" action
    }
}
