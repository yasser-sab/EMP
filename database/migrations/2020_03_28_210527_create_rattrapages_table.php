<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRattrapagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rattrapages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dateRattrapage');
            $table->date('dateARattrapager');
            $table->biginteger('typerattrapage_id')->unsigned();
            $table->foreign('typerattrapage_id')->references('id')->on('typerattrapages');
            $table->unique(['dateRattrapage','dateARattrapager']);
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
        Schema::dropIfExists('rattrapages');
    }
}
