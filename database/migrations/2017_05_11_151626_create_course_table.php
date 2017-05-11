<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string("name", 60)->comment("課程名稱");
            $table->dateTime("createDate")->comment("開課時間");
            $table->string("remark", 100)->comment("課程備註");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}
