<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;

class DashboardController extends Controller
{
    public function index()
    {
        return view('todos/tabulator',);
    }

    public function store(StoreTodoRequest $request) {
        $user['user_id']=Auth::id();
        
        $Todo = new Todo();
        $Todo -> fill($request->all());
        $Todo -> fill( $user);
        $isSaved = $Todo -> save();
        if($isSaved)
            return response()->json(['Data saved'],200);
        else 
           return response()->json(['Data could not saved'],422);
    }
}
