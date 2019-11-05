<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keyword');
            $table->string('urlProiect');
            /*$table->integer('search_engine_id');*/
            $table->string('search_engine_name');
            $table->string('search_engine_language');
            // $table->integer('location_id');
            $table->string('location_name');
            $table->bigInteger('taskjobs')->default('0');

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
        Schema::dropIfExists('tasks');
    }
}
