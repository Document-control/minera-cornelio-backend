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
        Schema::create('history_doc_secondays', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doc_secondary_id')->constrained('doc_secondaries');
            $table->foreignId('contract_id')->constrained('contracts');

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
        Schema::dropIfExists('history_doc_secondays');
    }
};
