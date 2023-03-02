<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login/register',[
            'layout' => 'login'
        ]);
    }

    public function store(RegisterRequest $request)
    {
        
        $data = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
            'gender' => $request->input("gender"),
            'active' => 1,
            'remember_token' => Str::random(10)
        ]);
        
        return response()->json($data);
    }
}
