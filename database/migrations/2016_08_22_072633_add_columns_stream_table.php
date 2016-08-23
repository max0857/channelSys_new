<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stream',function(Blueprint $table){
            $table->integer('product_id');
            $table->integer('channel_id');
            $table->integer('business_id');
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
            $table->drop_column('product_id');
            $table->drop_column('channel_id');
            $table->drop_column('business_id');
        });
    }
}
