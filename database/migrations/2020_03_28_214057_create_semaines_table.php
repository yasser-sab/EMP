<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemainesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semaines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dateDSemaine');
            $table->date('dateFSemaine');
            $table->timestamps();
            $table->unique(['dateDSemaine','dateFSemaine']);
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
        Schema::dropIfExists('semaines');
    }
}
