<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilierFormateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filier_formateur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('formateur_id')->unsigned();
            $table->biginteger('filier_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs');
            $table->foreign('filier_id')->references('id')->on('filiers');
            $table->unique(['formateur_id','filier_id']);
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
        Schema::dropIfExists('filier_formateur');
    }
}
