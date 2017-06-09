<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('no', 191)->default('');
            $table->integer('member_id')->unsigned();
            $table->integer('status')->unsigned();
            $table->integer('sum')->unsigned();
            $table->string('email');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_mobile');
            $table->string('codezip', 10);
            $table->string('address');
            $table->integer('shipping_fee')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
