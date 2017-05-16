<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourseGrade extends Model
{
    protected $table = 'student_course_grade';

    public $timestamps = false;

    public $fillable = [
        "studentId",
        "courseId",
        "gradelevel"
    ];

}
