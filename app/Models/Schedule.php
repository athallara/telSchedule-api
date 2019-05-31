<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model{

    protected $fillable = [
        'day','startTime','endTime','type'
    ];

    protected $hidden = [
        'course_id',
    ];

    public function Course()
    {
        return $this->belongsTo('App\Models\Course');
    }

}