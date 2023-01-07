<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_summaries', function (Blueprint $table) {
            $table->id();

            $table->integer('initial_month');
            $table->decimal('factory_tmh', 10, 2);
            $table->string('trader');
            $table->string('trader_number');
            $table->decimal('amount_pen', 10, 2);
            $table->decimal('amount_acu', 10, 2)->nullable();

            $table->foreignId('contract_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('factory_plant_id')->constrained('factory_plants');
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
        Schema::dropIfExists('tech_summaries');
    }
};
