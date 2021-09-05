<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiSanctumController extends Controller
{
    public function index(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if(!$user || Hash::check($request->password,$user->password))
        {
            return response([
                'message'=>['these credentials does not match our record']
            ],404);
        }
        $token= $user->createToken('my-app-token')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }
}
