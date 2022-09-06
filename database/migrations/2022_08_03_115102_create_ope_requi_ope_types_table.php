<?php

use App\Models\OpeRequiOpeType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeRequiOpeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ope_requi_ope_types', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                OpeRequiOpeType::PENDIENTE,
                OpeRequiOpeType::DESAPROBADO,
                OpeRequiOpeType::APROBADO,
                OpeRequiOpeType::ANULADO
            ])->default(OpeRequiOpeType::PENDIENTE);
            $table->text('observation')->nullable();

            $table->foreignId('operation_type_id')->constrained('operation_types');
            $table->foreignId('operation_requirement_id')->constrained('operation_requirements');

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
        Schema::dropIfExists('ope_requi_ope_types');
    }
}
