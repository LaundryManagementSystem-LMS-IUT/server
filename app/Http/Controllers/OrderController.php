<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\order;
use App\Models\order_detail;
use Exception;
use App\Models\manager;
use Illuminate\Support\Facades\Log;



class OrderController extends Controller
{
    public function getPricing(string $email)
    {
        try{
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
        
            return response()->json($responseServices);
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        if ($pricing !== null) {
            $pricingCount = count($pricing);
        } else {
            $pricingCount = 0;
        }
        Log::info($pricing);
        foreach ($pricing as $price) {
            Log::info('1');
            $clothType = $price['ClothType'];
            Log::info('2');
            $wash = $price['Wash'];
            Log::info('3');
            $iron = $price['Iron'];
            Log::info('4');
            $washAndIron = $price['WashAndIron'];
            Log::info('5');
            $dryClean = $price['DryClean'];
            Log::info('6');
            
            $this->updateServicePrice($managerEmail, $clothType, 'Wash', $wash);
            Log::info('7');
            $this->updateServicePrice($managerEmail, $clothType, 'Wash & Iron', $washAndIron);
            Log::info('8');
            $this->updateServicePrice($managerEmail, $clothType, 'Dry Clean', $dryClean);
            Log::info('9');
            $this->updateServicePrice($managerEmail, $clothType, 'Iron', $iron);
            Log::info('10');
        }


        return response()->json(['message' => 'Pricing updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    private function updateServicePrice($managerEmail, $clothType, $operation, $price)
    {
        
        try{
            $item = service::where('manager_email', $managerEmail)
            ->where('cloth_type', $clothType)
            ->where('operation', $operation)
            ->first();
        if ($item) {
            Log::info('11');
            $newItem = service::where('manager_email', $managerEmail)
            ->where('cloth_type', $clothType)
            ->where('operation', $operation)
            ->update(['price' => $price]);
            // $item['price'] = $price;
            // $item->update();
        } else {
            $another = new service();
            $another->manager_email = $managerEmail;
            $another->cloth_type = $clothType;
            $another->operation = $operation;
            $another->price = $price;
            $another->save();
        }}catch (\Exception $e) {
            Log::info("Error is ");
            Log::info($e);
        }
    }


    public function addOrder(Request $request){
        Log::info($request);

        $order = order::create([
            'customer_email'=>$request->input('customer_email'),
            'manager_email'=>$request->input('manager_email'),
            'status'=>'PENDING',
            'payment'=>$request->input('payment'),
        ]);
        
        $newOrderDetails = $request->input('orderList'); //we get the list
        $order=order::where('customer_email',$request->input('customer_email'))->where( 'manager_email',$request->input('manager_email'))
        ->latest()
    ->first();
        foreach ($newOrderDetails as $newOrderDetail) {
            order_detail::create([
               'order_id'=>$order->order_id,
               'cloth_type'=>$newOrderDetail['cloth_type'],
               'operation'=>$newOrderDetail['operation'],
               'manager_email'=>$request->input('manager_email'),
               'completed'=>false,
               'quantity'=>$newOrderDetail['quantity']
            ]);
        }
        return response()->json(['message' => 'Order added successfully!']);
    }

    public function get_services($manager_email){
        try{
            $services=service::where('manager_email',$manager_email)->get();
            return response()->json(['services' => $services]);
        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
