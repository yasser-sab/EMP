<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomG')->unique();
            $table->biginteger('filier_id')->unsigned();
            $table->biginteger('niveau_id')->unsigned();
            $table->foreign('filier_id')->references('id')->on('filiers');
            $table->foreign('niveau_id')->references('id')->on('niveaus');
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
        Schema::dropIfExists('groupes');
    }
}
