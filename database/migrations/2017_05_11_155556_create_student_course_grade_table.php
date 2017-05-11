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
            $table->integer("sudentId")->unsigned()->comment("學生ID");
            $table->foreign('sudentId')->references('id')->on('student');
            $table->integer("courseId")->unsigned()->comment("課程ID");
            $table->foreign('courseId')->references('id')->on('course');
            $table->char('gradelevel', 1);
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
