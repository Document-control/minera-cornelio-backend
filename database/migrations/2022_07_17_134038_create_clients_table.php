<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [Client::NATURAL, Client::COMPANY]);
            $table->string('ruc', 11);
            $table->string('code'); // INICIALES DE LA EMPRESA O DE LA PERSONA.
            $table->enum('status',  [Client::ANULADO, Client::VIGENTE, Client::PENDIENTE, Client::INACTIVO]);

            $table->foreignId('person_id')->constrained('people');
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->foreignId('business_type_id')->nullable()->constrained('business_types');

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
        Schema::dropIfExists('clients');
    }
}
