<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\order;
use App\Models\order_detail;
use Illuminate\Support\Facades\Log;



class OrderController extends Controller
{
    //
    public function getPricing(string $email)
{
    $services = Service::where('manager_email', $email)->get();

    $groupedServices = $services->groupBy('cloth_type');
    Log::info($groupedServices);
    
    $arrayedServices=$groupedServices->map(function ($services, $clothType) {
        return [
            $services->map(function ($service) {
                return [$service->operation, $service->price];
            })->toArray()
        ];
    });

    $response = response()->json($groupedServices);

    return $response;
}

}
