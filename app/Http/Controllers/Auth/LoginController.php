<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request){

        $credentials = $request->only('username','password');

        $user = User::where('username', $credentials['username'])->first();

        if(!$user){
            return response()->json([
                'message' => 'Username not found!',
                'status'  => 'error',
            ], 401);
        }

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Gagal Login!']);
        }

        return response()->json([
            'message' => 'Berhasil Login',
            'Token'   => $token,
        ]);


    }
}