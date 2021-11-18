<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleFilierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_filier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('module_id')->unsigned();
            $table->biginteger('filier_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('filier_id')->references('id')->on('filiers');
            $table->unique(['filier_id','module_id']);
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
        Schema::dropIfExists('module_filier');
    }
}
