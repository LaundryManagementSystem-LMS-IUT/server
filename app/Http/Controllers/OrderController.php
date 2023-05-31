<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\order;
use App\Models\manager;
use App\Models\order_detail;
use Illuminate\Support\Facades\Log;



class OrderController extends Controller
{
    public function getPricing(string $email)
    {
        $services = service::where('manager_email', $email)->get();
    
        $groupedServices = $services->groupBy('cloth_type');
    
        $responseServices = $groupedServices->map(function ($services, $clothType) {
            $clothTypeData = [
                'ClothType' => $clothType,
                'Wash' => 0,
                'Iron' => 0,
                'WashAndIron' => 0,
                'DryClean' => 0,
            ];
    
            $services->each(function ($service) use (&$clothTypeData) {
                switch ($service->operation) {
                    case 'Wash':
                        $clothTypeData['Wash'] = (double) $service->price;
                        break;
                    case 'Iron':
                        $clothTypeData['Iron'] =(double)  $service->price;
                        break;
                    case 'Wash & Iron':
                        $clothTypeData['WashAndIron'] = (double) $service->price;
                        break;
                    case 'Dry Clean':
                        $clothTypeData['DryClean'] = (double) $service->price;
                        break;
                    default:
                        // Handle any other operations if needed
                        break;
                }
            });
    
            return $clothTypeData;
        })->values(); // Use values() to reset the array keys and get a sequential array
    
        $response = response()->json($responseServices);
    
        return $response;
    }

    // function getItemPrice(Request $manager_email){
        
    // }

    public function addItem (Request $request)
    {
        Log::info($request);
        if(!is_null($request->input('wash_price'))){
            $service = new service();
            $service->manager_email = $request->input('manager_email');
            $service->cloth_type = $request->input('item_name');
            $service->operation = 'Wash';
            $service->price = $request->input('wash_price');
            $service->save();
            Log::info($service);
        }
        if(!is_null($request->input('iron_price'))){
            $service = new service();
            $service->manager_email = $request->input('manager_email');
            $service->cloth_type = $request->input('item_name');
            $service->operation = 'Iron';
            $service->price = $request->input('iron_price');
            $service->save();
            Log::info($service);
        }
        if(!is_null($request->input('washAndIron_price'))){
            $service = new service();
            $service->manager_email = $request->input('manager_email');
            $service->cloth_type = $request->input('item_name');
            $service->operation = 'Wash & Iron';
            $service->price = $request->input('washAndIron_price');
            $service->save();
            Log::info($service);
        }
        if(!is_null($request->input('dryClean_price'))){
            $service = new service();
            $service->manager_email = $request->input('manager_email');
            $service->cloth_type = $request->input('item_name');
            $service->operation = 'Dry Clean';
            $service->price = $request->input('dryClean_price');
            $service->save();
            Log::info($service);
        }
        
    }


    public function updatePricing(Request $request)
    {
        try {
            $managerEmail = $request->input('manager_email');
            $pricing = $request->input('pricing');
            
            Log::info($pricing);
            $pricingCount = count($pricing);
            for ($i = 0; $i < $pricingCount; $i++) {
                $price = $pricing[$i];
                $clothType = $price['ClothType'];
                $wash = $price['Wash'];
                $iron = $price['Iron'];
                $washAndIron = $price['WashAndIron'];
                $dryClean = $price['DryClean'];
                
                $this->updateServicePrice($managerEmail, $clothType, 'Wash', $wash);
                $this->updateServicePrice($managerEmail, $clothType, 'Wash & Iron', $washAndIron);
                $this->updateServicePrice($managerEmail, $clothType, 'Dry Clean', $dryClean);
                $this->updateServicePrice($managerEmail, $clothType, 'Iron', $iron);
            }

            
            return response()->json(['message' => 'Pricing updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function updateServicePrice($managerEmail, $clothType, $operation, $price)
    {
        
        try{$item = service::where('manager_email', $managerEmail)
            ->where('cloth_type', $clothType)
            ->where('operation', $operation)
            ->first();
        
        if ($item) {
            $item->price = $price;
            $item->save();
        } else {
            $item = new service();
            $item->manager_email = $managerEmail;
            $item->cloth_type = $clothType;
            $item->operation = $operation;
            $item->price = $price;
            $item->save();
        }}catch (\Exception $e) {
            Log::info("Error is ");
            Log::info($e);
        }
    }

    // private function deleteService($managerEmail, $clothType, $operation)
    // {
    //     $item = service::where('manager_email', $managerEmail)
    //         ->where('cloth_type', $clothType)
    //         ->where('operation', $operation)
    //         ->first();
        
    //     if ($item) {
    //         $item->price = 0;
    //     }
    // }

    public function addOrder(Request $request){
        Log::info($request);
        // name: string; operation: string; quantity: number
        //payment
        //customer email and manager email

        //we find manager id
        // $manager = manager::where('email', $request->input(''))->first();

        $order = order::create([
            'customer_email'=>$request->input('customer_email'),
            'manager_email'=>$request->input('customer_email'),
            'status'=>'PENDING'
        ]);
        
        $newOrderDetails = $request->input('orderList'); //we get the list
        
        foreach ($newOrderDetails as $newOrderDetail) {
            //save
        }
        return response()->json(['message' => 'Order added successfully!']);
    }

}
