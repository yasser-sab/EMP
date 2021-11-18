<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploiparamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploiparams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('jour_id')->unsigned();
            $table->biginteger('seance_id')->unsigned();
            $table->biginteger('formateur_groupe_module_id')->unsigned();
            $table->foreign('jour_id')->references('id')->on('jours');
            $table->foreign('seance_id')->references('id')->on('seances');
            $table->foreign('formateur_groupe_module_id')->references('id')->on('formateur_groupe_module');
            $table->unique(['jour_id','seance_id']);
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
        Schema::dropIfExists('emploiparams');
    }
}
