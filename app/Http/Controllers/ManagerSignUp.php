<?php

namespace App\Http\Controllers;

use App\Models\manager;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManagerSignUp extends Controller
{
    public function update(Request $request,$email){
        try{
            manager::where('email',$email)->update([
                'laundry_name'=>$request->input('laundry_name'),
                'phone_number'=>$request->input('phone_number'),
                'opening_time'=>$request->input('opening_time'),
                'closing_time'=>$request->input('closing_time'),
            ]);
            user::where('email',$email)->update([
                'profile_picture'=>$request->input('profile_picture'),
            ]);
            $location=$request->input('location');
            DB::statement('UPDATE managers SET address=ROW(' . $location['lat'] . ', ' . $location['lng'] . ')::ADDRESS_TYPE WHERE email=\'' . $email . '\'');
            return response()->json(['userType'=>'manager'], 200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

    public function show($laundry_id){
         try{
           $result=manager::where('laundry_id',$laundry_id)->first();
           return response()->json(['laundry'=>$result],200);
         }
         catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
         }
    }
}
