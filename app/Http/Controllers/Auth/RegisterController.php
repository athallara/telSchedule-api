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
            'email'      => 'required',
            'university' => 'max:50',
            'major'      => 'max:50',
            'classGroup' => 'max:50'
        ]);

        $user = new User;
        $user->username   = $request->username;
        $user->fullname   = $request->fullname;
        $user->password   = Hash::make($request->password);
        $user->email      = $request->email;
        $user->university = $request->university;
        $user->major      = $request->major;
        $user->classGroup = $request->classGroup;
        $user->save();

        return response()->json([
            //'token'   => Auth::login($user),
            'status'  => 'success',
            'message' => 'Berhasil Daftar!',
        ]);
    }

    public function takeAll(Request $request){
        $token = app('auth')->attempt($request->only('username', 'password'));

    return response()->json(compact('token'));
    }
}
