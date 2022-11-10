<?php

use App\Models\parkingPlace;
use App\Models\Size;
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
        Schema::create('parking_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(parkingPlace::class);
            $table->foreignIdFor(Size::class);
            $table->integer('basePrice')->unsigned()->comment('GBP');
            $table->json('dailyRate')->nullable();
            $table->json('hourlyRate')->nullable();
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
        Schema::dropIfExists('parking_prices');
    }
};
