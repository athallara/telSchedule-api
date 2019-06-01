<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ScheduleController extends Controller{
    
    public function __construct(){
        // $this->middleware('ValidateToken');
    }

    public function getCourseFromSchedule()
    {
        //Reversed Logic, Get Course from Schedule

        $user = User::findorfail(Auth::user()->id);
        $schedules = $user->CourseSchedule()->with('course')->get();

        // Example How to Access Course from Schedule
        // foreach($schedules as $schedule){
        //     echo $schedule->day;
        //     echo $schedule->course->courseName;
        // }
        return $schedules;
    }

    public function daynow()
    {
        // $day = Carbon::now();

        // $date = '2018-11-15';
        // $d    = new DateTime($date);
        // $d->format('l');

        return Carbon::now()->format('l');
    }

}