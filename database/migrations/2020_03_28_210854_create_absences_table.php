<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('typeabsence_id')->unsigned();
            $table->biginteger('rattrapage_id')->unsigned();
            $table->foreign('typeabsence_id')->references('id')->on('typeabsences');
            $table->foreign('rattrapage_id')->references('id')->on('rattrapages');
            $table->unique(['typeabsence_id','rattrapage_id']);
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
        Schema::dropIfExists('absences');
    }
}
