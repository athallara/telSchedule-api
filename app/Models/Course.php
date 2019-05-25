<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model{

    protected $fillable = [
        'courseName', 'courseCode', 'courseDesc', 'lectureName', 'lectureCode', 'lectureContact'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App/Models/User');
    }
}