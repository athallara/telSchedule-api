<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

class UserController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function getUserProfile(){
        $user = User::findorfail(Auth::user()->id);
        return $user;
    }

    public function updateUserProfile(Request $request){

        try{

        $user = User::findorfail(Auth::user()->id);
        $user->username   = $request->username;
        $user->fullname   = $request->fullname;
        $user->password   = Hash::make($request->password);
        $user->university = $request->university;
        $user->major      = $request->major;
        $user->classGroup = $request->classGroup;
        $user->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Successfully Update Profile',
        ],200);
        
        }catch(QueryException $e){
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed Update Profile',
            ],400);
        }
        
        // This is bug, id can be updated via request; wtf;
        // $input = $request->all();
        // $input['password'] = Hash::make($request->password);
        // $update = User::where('id', Auth::user()->id)->update($input);
    }
}
