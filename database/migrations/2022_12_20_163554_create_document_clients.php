<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_clients', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('document_id')->constrained('documents');

            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();

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
        Schema::dropIfExists('document_clients');
    }
}
