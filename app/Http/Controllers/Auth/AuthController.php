<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','logout']]);
    }

    
    public function register(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'fullname'   => 'required',
            'password'   => 'required|min:5',
            'university' => 'max:50',
            'major'      => 'max:50',
            'classGroup' => 'max:50'
        ]);

        $user = new User;
        $user->username   = $request->username;
        $user->fullname   = $request->fullname;
        $user->password   = Hash::make($request->password);
        $user->university = $request->university;
        $user->major      = $request->major;
        $user->classGroup = $request->classGroup;
        $user->save();

        $token = Auth::login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username','password');

        $user = User::where('username', $credentials['username'])->first();

        if(!$user){
            return response()->json([
                'status'  => 'error',
                'message' => 'Username not found!',
            ], 401);
        }

        $token = Auth::attempt($credentials);

        if (!$token){ 
            return response()->json([
                'status'  => 'error',
                'message' => 'Login Failed! Invalid Credentials!'], 401);
        } else

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status'  => 'success',
            'message' => 'Successfully Logged Out!',
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status'        => 'success',
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => Auth::factory()->getTTL() * 60
        ])->header('Authorization', sprintf('Bearer %s', $token));

    }
}