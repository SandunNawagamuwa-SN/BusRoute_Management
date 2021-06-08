<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusScheduleBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_schedule_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_seat_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bus_schedule_id')->nullable();
            $table->unsignedInteger('seat_number');
            $table->decimal('price',8,2);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('bus_seat_id')->references('id')->on('bus_seates')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_schedule_bookings');
    }
}
