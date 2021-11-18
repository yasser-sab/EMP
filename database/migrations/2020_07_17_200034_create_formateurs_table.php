<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formateurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nomF");
            $table->string("prenomF");
            $table->string("emailF")->unique();
            $table->string("telF")->unique();
            $table->string("adrF");
            $table->biginteger("salle_id")->unsigned();
            $table->float("cumAbsGlo")->default("0.0");
            $table->float("cumEnsGlo")->default("0.0");
            $table->float("cumAut")->default("0.0");
            $table->float("cumCm")->default("0.0");
            $table->float("cumMiss")->default("0.0");
            $table->float("cumRat")->default("0.0");
            $table->float("masHorAnnuelPrevisionnel")->default("0.0");
            $table->datetime('deleted_at')->nullable();
            $table->foreign('salle_id')->references('id')->on('salles');
            
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
        Schema::dropIfExists('formateurs');
    }
}
