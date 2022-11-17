<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class parkingPlace extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function parkingPrices(): HasMany
    {

        return $this->hasMany(parkingPrice::class);
    }

    /**
     * @return HasMany
     */
    public function parkingSpots(): HasMany
    {
        return $this->hasMany(parkingSpot::class,'parking_spot_id');
    }

    /**
     * @return belongsToMany
     */
    public function spotAttributes(): belongsToMany
    {
        return $this->belongsToMany(parkingSpotAttribute::class)->withPivot('hourly_price');
    }
}
