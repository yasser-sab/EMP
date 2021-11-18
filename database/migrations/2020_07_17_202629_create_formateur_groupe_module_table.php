<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormateurGroupeModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formateur_groupe_module', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('formateur_id')->unsigned();
            $table->biginteger('groupe_id')->unsigned();
            $table->biginteger('module_id')->unsigned();
            $table->float('cumMod')->default('0.0');
            $table->float('cumAbs')->default('0.0');
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->unique(['groupe_id','module_id']);
            $table->foreign('formateur_id')->references('id')->on('formateurs');
            $table->foreign('groupe_id')->references('id')->on('groupes');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formateur_groupe_module');
    }
}
