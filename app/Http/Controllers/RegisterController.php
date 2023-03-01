<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Users;
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
        $data = Users::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'email_verified_at' => now(),
            'password' => $request->input("password"),
            'gender' => ['male', 'female'][rand(0, 1)],
            'active' => 1,
            'remember_token' => Str::random(10)
        ]);
        
        return response()->json($data);
    }
}
