<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function getAllUser()
    {
        $x = Auth::user()->id;
        dd($x);
        return User::all();
    }
}
