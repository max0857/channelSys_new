<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChanageStreamUserproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stream',function(Blueprint $table){
            $table->integer('share');
        });
        Schema::table('userproduct',function(Blueprint $table){
            $table->integer('rule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stream',function($table){
            $table->drop_column('share');
        });
        Schema::table('userproduct',function($table){
            $table->drop_column('rule_id');
        });
    }
}
