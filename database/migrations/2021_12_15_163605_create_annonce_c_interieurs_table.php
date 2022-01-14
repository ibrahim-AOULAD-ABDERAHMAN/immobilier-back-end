<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnonceCInterieursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce_c_interieurs', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('id_annonce')->unsigned();
            $table->foreignId('id_c_interieur')->unsigned();
            // Foriegn key
            $table->foreign('id_annonce')->references('id')->on('annonces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_c_interieur')->references('id')->on('c_interieurs')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce_c_interieurs');
    }
}
