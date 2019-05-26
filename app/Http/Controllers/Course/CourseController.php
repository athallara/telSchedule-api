<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;


class CourseController extends Controller{
    
    public function __construct()
    {
        $this->middleware('ValidateToken');         
    }

    public function createUserCourse(Request $request)
    {
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
            'message' => 'Course Successfully Added!',
        ], 200);

    }

    public function getUserCourse()
    {
        $user = User::findorfail(Auth::user()->id);
        return response()->json([
            'status'  => 'success',
            'body'    => $user->courses,
        ]);
    }
}