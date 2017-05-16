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
            $table->increments('id')->comment("流水編號");
            $table->string("name", 60)->comment("專案中文或英文名稱");
            $table->date("createDate")->comment("建立日期");
            $table->string("remark", 100)->nullable()->comment("備註");
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
