<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string("name", 60)->comment("姓名");
            $table->dateTime("birthday")->comment("生日");
            $table->dateTime("registerDate")->comment("註冊日期");
            $table->string("remark", 100)->comment("備註");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
