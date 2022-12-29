<?php

use App\Models\Email;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', [Email::PERSONAL, Email::CORPORATIVE])->default(Email::CORPORATIVE);
            $table->boolean('main')->default(true);

            $table->foreignId('person_id')->nullable()->constrained('people');
            $table->foreignId('client_id')->nullable()->constrained();
            $table->foreignId('profile_id')->nullable()->constrained();

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
        Schema::dropIfExists('emails');
    }
}
