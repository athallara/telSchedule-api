<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller{
    

    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function getAllUser()
    {
        Auth::user()->id;
        return User::all();
    }
}
