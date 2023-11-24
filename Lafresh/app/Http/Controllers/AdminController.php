<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        // $request->session()->regenerate();
        return response()->json("Admin logged in succesfully");
        
        // return redirect()->intended(::HOME);
    }
    
    public function AdminProfile($id){
        $Admin = User::findOrFail($id);
        return response()->json($Admin); 
    }

    public function AdminProfileUpdate(Request $request, $id){
        
        $user = User::findOrFail($id);
    
        // Update user model with validated data
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->phone = $request->input('phone', $user->phone);
        $user->address = $request->input('address', $user->address);
        
        $user->save();
        return response()->json($user);
    }
}