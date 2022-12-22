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
        Schema::create('history_doc_clients', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('contracts_id')->constrained('contracts');
            $table->foreignId('doc_client_id')->constrained('document_clients');

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
        Schema::dropIfExists('history_doc_clients');
    }
};
