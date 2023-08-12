<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomRequestPasswordController extends Controller
{
    public function index(Request $request) {
        return view('auth.reset-password',[
            'email' => $request->query('email'),
            'token' => $request->query('token'),
        ]);
    }
}
