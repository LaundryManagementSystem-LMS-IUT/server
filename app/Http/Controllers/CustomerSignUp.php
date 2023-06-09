<?php

namespace App\Http\Controllers;

use App\Models\address_resolve;
use App\Models\customer;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerSignUp extends Controller
{
    public function update(Request $request,$email){
        try{
            customer::where('email',$email)->update([
                'phone_number'=>$request->input('phone_number'),
            ]);
            user::where('email',$email)->update([
                'profile_picture'=>$request->input('profile_picture'),
            ]);
            $location=$request->input('location');
            address_resolve::create([
                'latitude'=>$location['lat'],
                'longitude'=>$location['lng'],
                'formatted_address'=>$request->input('address')
            ]);
            DB::statement('UPDATE customers SET address=ROW(' . $location['lat'] . ', ' . $location['lng'] . ')::ADDRESS_TYPE WHERE email=\'' . $email . '\'');
            return response()->json(['userType'=>'customer'], 200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

    public function show($email){
        try{
          $result=user::where('email',$email)->select('username','profile_picture','email')->first();
          return response()->json(['customer'=>$result],200);
        }
        catch(Exception $e){
           Log::error('An error occurred: ' . $e->getMessage());
           return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
   }
}
