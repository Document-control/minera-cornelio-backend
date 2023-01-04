<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('direction');
            $table->string('department');
            $table->string('district');
            $table->string('province');
            $table->text('reference')->nullable();
            $table->boolean('main')->default(true);

            $table->foreignId('person_id')->nullable()->constrained('people');
            $table->foreignId('profile_id')->nullable()->constrained('profiles');
            $table->foreignId('client_id')->nullable()->constrained();

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
        Schema::dropIfExists('addresses');
    }
}
