<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\manager;
use App\Models\review_laundry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewLaundry extends Controller
{
    public function store(Request $request){
        try{
            $review=review_laundry::create([
                'manager_email'=>$request->input('manager_email'),
                'customer_email'=>$request->input('customer_email'),
                'review'=>$request->input('review'),
                'review_stars'=>$request->input('review_stars')
            ]);
            return response()->json(['review'=>$review],200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }

    }

    public function showAll($manager_email){
        try{
            $result = review_laundry::join('users','email','=','customer_email')->where('manager_email',$manager_email)->select('profile_picture','username','review','review_stars')->get();
             return response()->json(['reviews'=>$result],200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

    public function show($customer_email,$laundry_id){
        try{
            $managers=manager::join('review_laundries','manager_email','=','email')->where('manager.laundry_id',$laundry_id)->select('manager_email')->first();
            $result = review_laundry::where(function ($query) use ($customer_email, $managers) {
            $query->where('customer_email', $customer_email)
                ->where('manager_email', $managers->manager_email);
             })->get();
             return response()->json(['reviews'=>$result],200);
        }
        catch(Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred '.$e->getMessage()], 400);
        }
    }

    public function showOne($laundry_id){

    }
}
