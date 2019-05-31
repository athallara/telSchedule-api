<?php

namespace App\Http\Controllers\Course;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CourseController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function createUserCourse(Request $request){
        $course = new Course;
        $course->courseName     = $request->courseName;
        $course->courseCode     = $request->courseCode;
        $course->courseDesc     = $request->courseDesc;
        $course->lectureName    = $request->lectureName;
        $course->lectureCode    = $request->lectureCode;
        $course->lectureContact = $request->lectureContact;
        $course->user_id        = Auth::user()->id;
        $course->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Course Successfully Added',
        ],200);
    }

    public function getUserCourse(){

        $user = User::findorfail(Auth::user()->id);

        //Bug : Still Reversed, First Collection should be Course not Schedule, Error in Eloquent
        $schedule = $user->CourseSchedule()->with('course')->get();

        // dd($user->CourseSchedule->where('course_id', 22)); //How To get Spesific Course List with Schedule, will be used later...

        //How to Access Course & Schedule dat Collections
        // foreach($schedules as $schedule){
        //     echo $schedule->day;
        //     echo $schedule->course->courseName;
        // }
        foreach($user->courses as $course);
        
        if(empty($course)){
            return response()->json([
                'status'  => 'success',
                'message' => 'Empty Course',
            ],200);
        }else return $schedule;
    }

    public function updateUserCourse(Request $request, $id){
        $input = $request->all();
        $update = Course::where('id', $id)->where('user_id', Auth::user()->id)->update($input);

        if($update):
            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully Update Course',
            ],200);
        else:
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed Update Course',
            ],400);
        endif;
    }

    public function deleteUserCourse(Request $request, $id){
        $course = Course::where('id', $id)->where('user_id', Auth::user()->id)->delete();

        if($course):
            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully Delete Course',
            ],200);
        else:
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed Delete Course',
            ],400);
        endif;

    }
}