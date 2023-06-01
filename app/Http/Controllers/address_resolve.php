<?php

namespace App\Http\Controllers;

use App\Models\address_resolve as ModelsAddress_resolve;
use Exception;
use Illuminate\Http\Request;

class address_resolve extends Controller
{
    public function show(Request $request){
        try{
            $latitude=$request->input('lat');
            $longitude=$request->input('lng');
            $result=ModelsAddress_resolve::where('latitude',$latitude)->where('longitude',$longitude)->first();
            return response()->json(['address'=>$result], 200);
        }
        catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()], 400);
        }

    }
}
