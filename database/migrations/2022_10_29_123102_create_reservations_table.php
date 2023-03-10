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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignIdFor(\App\Models\parkingSpot::class)->index();
            $table->foreignIdFor(\App\Models\User::class)->index();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('paid_at')->nullable();
            $table->integer('paid_amount')->nullable()->unsigned()->comment('GBP');
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
        Schema::dropIfExists('reservations');
    }
};
