<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('formateur_id')->unsigned();
            $table->biginteger('salle_id')->unsigned();
            $table->biginteger('groupe_id')->unsigned();
            $table->biginteger('module_id')->unsigned();
            $table->biginteger('seance_id')->unsigned();
            $table->biginteger('absence_id')->nullable()->unsigned();
            $table->biginteger('jour_id')->unsigned();
            $table->biginteger('semaine_id')->unsigned();
            $table->date('date');
            $table->string('isvalide')->default('non');
            $table->string('presence')->default('oui');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->foreign('formateur_id')->references('id')->on('formateurs');
            $table->foreign('salle_id')->references('id')->on('salles');
            $table->foreign('groupe_id')->references('id')->on('groupes');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('seance_id')->references('id')->on('seances');
            $table->foreign('absence_id')->references('id')->on('absences');
            $table->foreign('jour_id')->references('id')->on('jours');
            $table->foreign('semaine_id')->references('id')->on('semaines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emplois');
    }
}
