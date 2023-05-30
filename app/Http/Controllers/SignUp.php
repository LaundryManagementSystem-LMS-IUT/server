<?php

namespace App\Http\Controllers;

use App\Models\password_auth;
use App\Models\user;
use Illuminate\Http\Request;

class SignUp extends Controller
{

    public function store(Request $request)
    {
        $user=user::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ]);
        return $user;
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
