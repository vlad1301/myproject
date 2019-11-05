<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerpResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::create('serp_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resultPostId');
            $table->bigInteger('resultTaskId');
            $table->bigInteger('resultSeId');
            $table->bigInteger('resultLocationId');
            $table->string('resultPostKey');
            $table->string('resultDatetime');
            $table->bigInteger('resultPosition');
            $table->string('resultUrl');
          /*
            $table->bigInteger('resultSeId');
            $table->bigInteger('resultLocationId');
            $table->bigInteger('resultKeyId');*/
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
        Schema::dropIfExists('serp_results');
    }
}
