<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStageGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_groupe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('stage_id')->unsigned();
            $table->biginteger('groupe_id')->unsigned();
            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('groupe_id')->references('id')->on('groupes');
            $table->unique(['stage_id','groupe_id']);
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stage_groupe');
    }
}
