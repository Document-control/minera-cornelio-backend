<?php

use App\Models\Contract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('status', [
                Contract::PENDIENTE,
                Contract::OBSERVADO,
                Contract::APROBADO,
                Contract::ENMARCHA, // HACER UN CRON QUE VALIDE LA FECHA DE INICIO PARA CAMBIAR EL ESTADO
                Contract::ANULADO
            ])->default(Contract::PENDIENTE);

            $table->foreignId('client_id')->constrained();

            $table->string('start_date');
            $table->string('end_date');


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
        Schema::dropIfExists('contracts');
    }
}
