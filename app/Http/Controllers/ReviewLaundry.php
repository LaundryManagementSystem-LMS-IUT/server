<?php

namespace App\Http\Controllers;


use App\Models\manager;
use App\Models\review_laundry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewLaundry extends Controller
{
    public function store(Request $request)
    {
        try {
            $result=review_laundry::where('manager_email',$request->input('manager_email'))->where('customer_email',$request->input('customer_email'))->first();
            if($result){
                review_laundry::where('manager_email',$request->input('manager_email'))->where('customer_email',$request->input('customer_email'))->update(['review'=>$request->input('review'),'review_stars'=>$request->input('review_stars')]);
                $review=$result=review_laundry::where('manager_email',$request->input('manager_email'))->where('customer_email',$request->input('customer_email'))->first();
                return response()->json(['review' => $review], 200);
            }
            $review = review_laundry::create([
                'manager_email' => $request->input('manager_email'),
                'customer_email' => $request->input('customer_email'),
                'review' => $request->input('review'),
                'review_stars' => $request->input('review_stars')
            ]);
            return response()->json(['review' => $review], 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred ' . $e->getMessage()], 400);
        }
    }

    public function showAll($manager_email)
    {
        try {
            $result = review_laundry::join('users', 'email', '=', 'customer_email')->where('manager_email', $manager_email)->select('profile_picture', 'username', 'review', 'review_stars')->get();
            return response()->json(['reviews' => $result], 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred ' . $e->getMessage()], 400);
        }
    }

    public function show(Request $request)
    {
        try {
            $laundry_id = $request->input('laundry_id');
            $customer_email = $request->input('customer_email');
            $managers = manager::join('review_laundries', 'review_laundries.manager_email', '=', 'managers.email')
                ->where('managers.laundry_id', $laundry_id)
                ->select('managers.email')
                ->first();

            if($managers){
                $result = review_laundry::where(function ($query) use ($customer_email, $managers) {
                    $query->where('customer_email', $customer_email)
                        ->where('manager_email', $managers->email);
                })->first();
    
    
    
                return response()->json(['reviews' => $result], 200);
            }
            else{
                throw new Exception('incorrect review assignment');
            }
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred ' . $e->getMessage()], 400);
        }
    }

    public function showOne(Request $request, $laundry_id)
    {
    }
}
