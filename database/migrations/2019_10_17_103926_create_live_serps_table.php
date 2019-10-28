<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveSerpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_serps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_interogare');
            $table->string('keyword');
            $table->text('URL');
            $table->integer('locatia');
            $table->string('se_id');
            $table->string('engine_name');
            $table->string('country');
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
        Schema::dropIfExists('live_serps');
    }
}
