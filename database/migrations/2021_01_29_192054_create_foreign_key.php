<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->foreignId('etat_id')->constrained()->default(1);//a verifier le default siça marche
        });

        Schema::table('taches', function (Blueprint $table) {
            $table->foreignId('etat_id')->constrained()->default(1);//a verifier le default siça marche
            $table->foreignId('activite_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key');
    }
}
