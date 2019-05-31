<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

}