<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoiteDeReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boite_de_receptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_type_de_bien')->unsigned();
            $table->string('planing', 30)->nullable();
            $table->string('civilite', 20);
            $table->string('nom_de_societe', 50)->nullable();
            $table->string('nom_complet', 50);
            $table->string('email', 30)->nullable();
            $table->string('telephone', 15);
            $table->string('message', 1000)->nullable();
            $table->string('ville', 30)->nullable();
            $table->string('adresse', 150)->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->boolean('is_read')->default(0);
            $table->foreignId('id_type_de_message')->unsigned();

            // Foriegn key
            $table->foreign('id_type_de_bien')->references('id')->on('type_de_biens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_type_de_message')->references('id')->on('type_de_messages')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('boite_de_receptions');
    }
}
