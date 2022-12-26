<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: AÑADIR TABLA DE TIPO DE NEGOCIO
        Schema::create('business_clients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->constrained();
            $table->foreignId('business_type_id')->constrained('business_types');
            // $table->float('rate');

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
        Schema::dropIfExists('client_mineral');
    }
}
