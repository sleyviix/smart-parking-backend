<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('parking_spot_spot_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\parkingSpot::class);
            $table->foreignIdFor(\App\Models\SpotAttribute::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('parking_spot_spot_attribute');
    }
};
