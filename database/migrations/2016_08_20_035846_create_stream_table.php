<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('own_id');
            $table->integer('terminal_id');
            $table->string('opt');
            $table->integer('withdraw_id');
            $table->integer('money');
            $table->tinyInteger('status');
            $table->text('rule_image');
            $table->string('self_order_id');
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
        Schema::drop('stream');
    }
}
