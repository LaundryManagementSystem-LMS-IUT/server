<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\order;
use App\Models\order_detail;
use App\Models\user;
use Exception;
use App\Models\manager;
use App\Models\customer;
use Illuminate\Support\Facades\Log;

class OrderHistoryController extends Controller
{
    //
    public function getCustomerOrderHistory(string $customerEmail){
        try{
            $orders = order::join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->where('orders.customer_email', $customerEmail)
            ->get([
                'orders.order_id',
                'orders.manager_email',
                'orders.payment',
                'orders.status',
                'order_details.cloth_type',
                'order_details.operation',
                'order_details.quantity'
            ]);

            $formattedOrders = [];
             foreach ($orders as $order) {
            $formattedOrder = [
                'id' => $order->order_id,
                'laundryName' => $this->getLaundryNameFromManagerEmail($order->manager_email),
                'payment' => $order->payment, // Replace with your logic to get the payment amount
                'status' => $order->status,
                'items' => []
            ];

            $formattedOrder['items'][] = [
                'name' => $order->cloth_type,
                'washType' => $order->operation,
                'quantity' => $order->quantity
            ];

            $formattedOrders[] = $formattedOrder;
        }
            Log::info(response()->json($formattedOrders));
            return response()->json($formattedOrders);

        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    private function getLaundryNameFromManagerEmail(string $managerEmail){
        $manager = manager::where('email', $managerEmail)->first();
        if ($manager) {
            return $manager->laundry_name;
        }
        return null;
        }


        public function getManagerOrderHistory(string $manager_email){
            try{
                $orders = order::join('order_details', 'orders.order_id', '=', 'order_details.order_id')
                ->where('orders.manager_email', $manager_email)
                ->get([
                    'orders.order_id',
                    'orders.manager_email',
                    'orders.payment',
                    'orders.status',
                    'order_details.cloth_type',
                    'order_details.operation',
                    'order_details.quantity'
                ]);
    
                $formattedOrders = [];
                 foreach ($orders as $order) {
                $formattedOrder = [
                    'id' => $order->order_id,
                    'userName' => $this->getUserNamefromEmail($order->manager_email),
                    'payment' => $order->payment, // Replace with your logic to get the payment amount
                    'status' => $order->status,
                    'items' => []
                ];
    
                $formattedOrder['items'][] = [
                    'name' => $order->cloth_type,
                    'washType' => $order->operation,
                    'quantity' => $order->quantity
                ];
    
                $formattedOrders[] = $formattedOrder;
            }
                Log::info(response()->json($formattedOrders));
                return response()->json($formattedOrders);
    
            }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }


        private function getUserNamefromEmail(string $customerEmail){
            $customer = user::where('email', $customerEmail)->first();
            if ($customer) {
                return $customer->username;
            }
            return null;
            }
}
