<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotSpotAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('spot_spot_attribute', function (Blueprint $table) {
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
        Schema::dropIfExists('spot_spot_attribute');
    }
};
