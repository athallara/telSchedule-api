<?php

namespace App\Http\Controllers\Schedule;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ScheduleController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function getDetailSchedule($scheduleId){

        $userId = $this->getUserId($scheduleId);
        if(is_null($userId) or $userId != Auth::user()->id) return response()->json([
            'status'  => 'error',
            'message' => 'Schedule Not Found!',
        ], 404);
        
        // This Method isn't Effective Because User Can Guess Schedule Id Available or Not! Bad Security!
        // if($userId != Auth::user()->id) return response()->json([
        //     'status'  => 'error',
        //     'message' => 'Unauthorized',
        // ], 401);

        $schedule = Schedule::findorfail($scheduleId);
        return $schedule;
    }


    protected function getUserId($scheduleId){
        $courseId = Schedule::select('course_id')->where('id', $scheduleId)->first();
        
        if(is_null($courseId)) return null;
        
        $userId = Course::select('user_id')->where('id', $courseId->course_id)->first();
        return $userId->user_id;

    }

    public function getCourseFromSchedule(){
        //Reversed Logic, Get Course from Schedule

        $user = User::findorfail(Auth::user()->id);
        $schedules = $user->CourseSchedule()->with('course')->get();

        // Example How to Access Course from Schedule, Frontend Implementation!

        // foreach($schedules as $schedule){
        //     echo $schedule->day;
        //     echo $schedule->course->courseName;
        // }
        return $schedules;
    }

    public function daynow(){
        // $day = Carbon::now();

        // $date = '2018-11-15';
        // $d    = new DateTime($date);
        // $d->format('l');

        return Carbon::now()->format('l');
    }

}