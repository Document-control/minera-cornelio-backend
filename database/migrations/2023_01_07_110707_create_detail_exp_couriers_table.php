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
        Schema::create('detail_exp_couriers', function (Blueprint $table) {
            $table->id();
            $table->string('plates');
            $table->string('weight');
            $table->decimal('total', 10, 2);
            $table->string('currency', 3)->default('PEN');

            $table->foreignId('expense_id')->constrained();
            $table->foreignId('courier_id')->constrained();

            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->index();

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
        Schema::dropIfExists('detail_exp_couriers');
    }
};
