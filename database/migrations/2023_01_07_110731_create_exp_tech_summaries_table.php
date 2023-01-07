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
        Schema::create('exp_tech_summaries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('expense_id')->constrained();
            $table->foreignId('tech_summary_id')->constrained('tech_summaries');

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
        Schema::dropIfExists('exp_tech_summaries');
    }
};
