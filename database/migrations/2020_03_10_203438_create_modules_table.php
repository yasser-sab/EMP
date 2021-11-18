<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("refMod")->unique();
            $table->string("nomMod")->unique();
            $table->string("abrMod")->unique();
            $table->string("masHor")->default("0.0");
            $table->biginteger("niveau_id")->unsigned();
            $table->integer("order")->unsigned();
            $table->foreign("niveau_id")->references("id")->on("niveaus");
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
        Schema::dropIfExists('modules');
    }
}
