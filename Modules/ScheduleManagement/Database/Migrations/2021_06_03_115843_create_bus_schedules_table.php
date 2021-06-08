<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_route_id')->nullable();
            $table->boolean('direction');
            $table->dateTime('start_timestamp',$precision = 0);
            $table->dateTime('end_timestamp',$precision = 0);
            $table->timestamps();

            $table->foreign('bus_route_id')->references('id')->on('bus_routes')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_schedules');
    }
}
