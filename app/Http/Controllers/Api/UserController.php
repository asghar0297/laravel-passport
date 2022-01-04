<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $response = [
            'data' => $users,
            'msg' => 'success'
        ];
        return response()->json($response);
    }

    public function register(Request $req){
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password)
        ]);

        $token = $user->createToken('lara-passport')->accessToken;

        return response()->json(['token' => $token], 200);

    }

    public function login(Request $request)
    {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();
            $success['token'] =  $user->createToken('Personal Access Token')->accessToken;

            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }





}
