<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiensTable extends Migration
{
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->string('titre');
            $table->string('type_bien');
            $table->string('type_transaction');
            $table->boolean('disponibilite');
            $table->decimal('prix', 10, 2);
            $table->string('adresse');
            $table->string('cp');
            $table->string('ville');
            $table->string('region');
            $table->string('pays');
            $table->float('superficie');
            $table->float('surface_terrain')->nullable();
            $table->integer('nb_etage')->nullable();
            $table->integer('nb_piece')->nullable();
            $table->integer('nb_chambre')->nullable();
            $table->unsignedBigInteger('id_agent')->nullable();
            $table->unsignedBigInteger('id_agence')->nullable();
            $table->timestamps();

            $table->foreign('id_agent')->references('id')->on('agents')->onDelete('set null');
            $table->foreign('id_agence')->references('id')->on('agences')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('biens');
    }
}