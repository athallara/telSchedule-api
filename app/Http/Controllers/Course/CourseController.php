<?php

namespace App\Http\Controllers\Course;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseController extends Controller{
    
    public function __construct(){
        $this->middleware('ValidateToken');
    }

    public function createCourse(Request $request){
        $course = new Course;
        $course->courseName     = $request->courseName;
        $course->courseCode     = $request->courseCode;
        $course->courseDesc     = $request->courseDesc;
        $course->lectureName    = $request->lectureName;
        $course->lectureCode    = $request->lectureCode;
        $course->lectureContact = $request->lectureContact;
        $course->user_id        = Auth::user()->id;
        $course->save();

        return $this->responseActionCourse($course, 'Create');
    }

    public function getCourse(){
        $user = User::findorfail(Auth::user()->id);
        $courses = $user->Courses;
        
        return $this->responseGetCourse($user,$courses);
    }

    public function getCourseAndSchedule(){
        // Access Schedule from Course
        $user = User::findorfail(Auth::user()->id);
        $courses = $user->Courses()->with('Schedule')->get();

        return $this->responseGetCourse($user,$courses);

        // How to Access Schedule from Course, Should be implement in frontend;
        // foreach($courses as $course){
        //     echo $course->schedule;
        //     foreach($course->schedule as $schedule){
        //         echo "hari : " . $schedule->day;
        //     }
        // }
    }

    public function getDetailCourse($courseId){

        //Check If This User Have Course or Not
        try{
            $course = Course::findorfail($courseId)->where('user_id',Auth::user()->id);
        }catch(ModelNotFoundException $e){
            return $this->responseNotFound();
        }
        
        //Check If The Course Have Schedule or Not
        $schedules = $course->where('id',$courseId)->with('Schedule')->first();
        return is_null($schedules) ? $this->responseNotFound() : $schedules;

    }

    public function updateCourse(Request $request, $courseId){
        $update = Course::where('id', $courseId)->where('user_id', Auth::user()->id)->update($request->all());
        return $this->responseActionCourse($update, 'Update');
    }

    public function deleteCourse($courseId){
        $course = Course::where('id', $courseId)->where('user_id', Auth::user()->id)->delete();
        return $this->responseActionCourse($course, 'Delete');
    }

    protected function responseNotFound()
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'Course Not Found',
        ], 404);
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
            ], 400);
        endif;
    }

    protected function responseGetCourse($user,$courses){
        foreach($user->courses as $course);

        if(empty($course)){
            return response()->json([
                'status'  => 'success',
                'message' => 'Empty Course',
            ],200);
        }else return $courses;

    }
}