<?php

namespace App\Http\Controllers\Schedule;

// use App\Models\User;
use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class ScheduleController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function createSchedule(Request $request, $courseId){

        $course = Course::where('id',$courseId)->where('user_id',Auth::user()->id)->first();
        if(is_null($course)) return $this->responseNotFound('Course');

        $schedule            = new Schedule;
        $schedule->day       = $request->day;
        $schedule->startTime = $request->startTime;
        $schedule->endTime   = $request->endTime;
        $schedule->type      = $request->type;
        $schedule->course_id = $courseId;
        $schedule->save();

        return $this->responseActionCourse($schedule, 'Create');
    }

    public function updateSchedule(Request $request, $scheduleId){
        $userId = $this->getUserId($scheduleId);
        if($this->checkUser($userId)) return $this->responseNotFound('Schedule');


        $update = Schedule::where('id', $scheduleId)->update($request->all());
        return $this->responseActionCourse($update, 'Update');
    }

    public function deleteSchedule($scheduleId){
        $userId = $this->getUserId($scheduleId);
        if($this->checkUser($userId)) return $this->responseNotFound('Schedule');

        $schedule = Schedule::where('id', $scheduleId)->delete();
        return $this->responseActionCourse($schedule, 'Delete');
    }

    public function getDetailSchedule($scheduleId){
        //Get user Id from Schedule, because schdule table doesn't have direct relation to User Table.
        $userId = $this->getUserId($scheduleId);
        if($this->checkUser($userId)) return $this->responseNotFound('Schedule');
        
        return Schedule::findorfail($scheduleId);

        // This Method isn't Effective Because User Can Guess Schedule Id Available or Not! Bad Security!
        // if($userId != Auth::user()->id) return response()->json([
        //     'status'  => 'error',
        //     'message' => 'Unauthorized',
        // ], 401);
    }

    public function getCourseFromSchedule(){
        //Reversed Logic, Get Course from Schedule, I think it will not be used.
        $user = User::findorfail(Auth::user()->id);
        $schedules = $user->CourseSchedule()->with('course')->get();

        return $schedules;

        // Example How to Access Course from Schedule, Frontend Implementation!
        // foreach($schedules as $schedule){
        //     echo $schedule->day;
        //     echo $schedule->course->courseName;
        // }
    }

    public function daynow(){
        // Later...
        return Carbon::now()->format('l');
    }

    protected function checkUser($userId){
        return is_null($userId) or $userId != Auth::user()->id;
    }


    protected function getUserId($scheduleId){
        $courseId = Schedule::select('course_id')->where('id', $scheduleId)->first();
        return is_null($courseId) ? null : Course::select('user_id')->where('id', $courseId->course_id)->first()->user_id;
    }

    protected function responseActionCourse($action, $message){
        if($action):
            return response()->json([
                'status'  => 'success',
                'message' => 'Sucessfully ' . $message . ' Course',
            ],200);
        else:
            //I started thinking this condition useless, but idc :v
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed ' . $message . ' Course',
            ],400);
        endif;
    }

    protected function responseNotFound($message)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message . ' Not Found',
        ],404);
    }

}