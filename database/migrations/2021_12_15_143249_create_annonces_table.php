<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction')->unsigned();
            $table->foreignId('id_type_de_bien')->unsigned();
            $table->foreignId('id_etat')->unsigned();
            // $table->integer('id_region')->unsigned();
            $table->foreignId('id_ville')->unsigned();
            $table->string('adresse', 300)->nullable();
            $table->tinyInteger('etages')->nullable();
            $table->tinyInteger('chambres')->nullable();
            $table->tinyInteger('salons')->nullable();
            $table->tinyInteger('sejours')->nullable();
            $table->tinyInteger('sale_de_bains')->nullable();
            $table->tinyInteger('toilettes')->nullable();
            $table->string('age_de_bien', 20)->nullable();
            $table->integer('surface')->nullable();
            $table->bigInteger('prix')->nullable();
            $table->string('lien_video', 250)->nullable();
            $table->string('titre', 75)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(0);
            $table->foreignId('id_user')->unsigned();

            // Foriegn key
            $table->foreign('id_transaction')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_type_de_bien')->references('id')->on('type_de_biens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_etat')->references('id')->on('etats')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('id_region')->references('id')->on('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_ville')->references('id')->on('villes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('annonces');
    }
}
