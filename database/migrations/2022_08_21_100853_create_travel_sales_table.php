<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_sales', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->double('price', 12, 2);
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('bus_chair_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('travel_id')->references('id')->on('travels')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

            $table->foreign('bus_id')->references('id')->on('buses')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

            $table->foreign('bus_chair_id')->references('id')->on('bus_chairs')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');

            $table->foreign('customer_id')->references('id')->on('customers')
                ->constrained()
                ->onUpdate('no action')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_sales');
    }
}
