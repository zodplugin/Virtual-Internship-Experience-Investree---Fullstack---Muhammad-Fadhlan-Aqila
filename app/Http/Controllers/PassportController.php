<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    public function register(Request $request){
        $register = Validator::make($request->all(),[
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($register->fails()){
            return response()->json($register->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('access Token')->accessToken;
        return response()->json([
            'message' => 'Account created successfully',
            'user' => $user,
            'token' => $token
        ]);

    }
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
