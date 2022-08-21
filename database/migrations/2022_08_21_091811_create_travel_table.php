<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('name', 200);
            $table->dateTime('date');
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('bus_id');
            
            $table->foreign('bus_id')->references('id')->on('buses')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

            $table->foreign('origin_id')->references('id')->on('origins')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');
            
            $table->foreign('destination_id')->references('id')->on('destinations')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

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
        Schema::dropIfExists('travel');
    }
}
