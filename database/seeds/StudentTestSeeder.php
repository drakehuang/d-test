<?php

use Illuminate\Database\Seeder;

class StudentTestSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('student')->truncate();
        DB::table('course')->truncate();
        DB::table('grade')->truncate();
        DB::table('student_course_grade')->truncate();

        $levelArray = ['A', 'B', 'C', 'D', 'E'];
        // student
        for ($i =1; $i <=20; $i++) {
            $data = [
                'name'         => "學生" . $i,
                'birthday'     => "1980-10-10",
                'registerDate' => date("Y-m-d"),
                'remark'       => "remark" . $i
            ];
            DB::table('student')->insert($data);

            DB::table('student_course_grade')->insert(['studentId' => $i, 'courseId' => '1', 'gradelevel' => $levelArray[rand(0,4)]]);
            DB::table('student_course_grade')->insert(['studentId' => $i, 'courseId' => '2', 'gradelevel' => $levelArray[rand(0,4)]]);
            DB::table('student_course_grade')->insert(['studentId' => $i, 'courseId' => '3', 'gradelevel' => $levelArray[rand(0,4)]]);
            DB::table('student_course_grade')->insert(['studentId' => $i, 'courseId' => '4', 'gradelevel' => $levelArray[rand(0,4)]]);
        }

        unset($data);

        // grade
        foreach ($levelArray as $key => $level) {
            DB::table('grade')->insert(['level' => $level]);
        }
        

        // course
        $data = [
                'name'       => "程式語言",
                'createDate' => "2017-05-10"
            ];
        DB::table('course')->insert($data);

        $data = [
                'name'       => "國文",
                'createDate' => "2017-05-10"
            ];
        DB::table('course')->insert($data);

        $data = [
                'name'       => "數學",
                'createDate' => "2017-05-10"
            ];
        DB::table('course')->insert($data);

        $data = [
                'name'       => "歷史",
                'createDate' => "2017-05-10"
            ];
        DB::table('course')->insert($data);
    }
}
