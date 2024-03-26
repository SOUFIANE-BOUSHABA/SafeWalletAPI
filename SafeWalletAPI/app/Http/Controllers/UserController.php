<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    //

    public function register(Request $request)
    {

        $user = user::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 2,
        ]);

     
      

        return $user;
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    
        $user = Auth::user();
        
      

        $userRole = $user->role; 
        
        $token = $user->createToken('token')->plainTextToken;
    
        return response()->json([
            'user' => $user,
            
            'token' => $token,
            'message' => 'Login successful'
        ], Response::HTTP_OK);
    }
    
    public function user()
    {
        $user = Auth::user();
    
        if ($user) {
            $userRole = $user->role; 
            return response()->json([
                'user' => $user,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
    

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], Response::HTTP_OK);
    }

}