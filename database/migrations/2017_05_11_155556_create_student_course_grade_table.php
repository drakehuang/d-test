<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCourseGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course_grade', function(Blueprint $table)
        {
            $table->integer("studentId")->unsigned();
            $table->foreign('studentId')->references('id')->on('student');
            $table->integer("courseId")->unsigned();
            $table->foreign('courseId')->references('id')->on('course');
            $table->char('gradelevel', 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_course_grade');
    }
}
