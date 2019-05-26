<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    public function __construct()
    {
        //
    }

    
    public function store(Request $request){
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