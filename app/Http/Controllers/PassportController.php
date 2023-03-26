<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($login)){
            $msg = 'Invalid Credential';
            return response()->json($msg);
        }

        $token = Auth::user()->createToken('access Token')->accessToken;
        return response()->json([
            'user' => Auth::user(),
            'access_token' => $token
        ]);
    }

    public function users(){
        $users = User::all();
        return response()->json($users);
    }
}
