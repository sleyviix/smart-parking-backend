<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingSpotAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_spot_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\parkingPlace::class);
            $table->foreignIdFor(\App\Models\SpotAttribute::class);
            $table->integer('hourly_price')->comment('£');
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
        Schema::dropIfExists('parking_spot_attribute');
    }
};
