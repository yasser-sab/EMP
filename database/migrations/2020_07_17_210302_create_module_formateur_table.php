<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleFormateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_formateur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('formateur_id')->unsigned();
            $table->biginteger('module_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->timestamps();
            $table->unique(['formateur_id','module_id']);
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
        Schema::dropIfExists('module_formateur');
    }
}
