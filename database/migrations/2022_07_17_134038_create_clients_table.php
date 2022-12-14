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
            $table->string('ruc', 11);
            $table->string('social_reason');
            $table->string('commercial_name');
            $table->string('code'); // INICIALES DE LA EMPRESA O DE LA PERSONA.
            $table->boolean('is_harvester')->default(false);
            $table->text('note');

            $table->foreignId('status_id')->constrained('client_status')->default(2); // ACTIVO

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
