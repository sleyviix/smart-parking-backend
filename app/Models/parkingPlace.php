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
        return $this->hasMany(parkingSpot::class);
    }

    /**
     * @return belongsToMany
     */
    public function spotAttributes(): belongsToMany
    {
        return $this->belongsToMany(SpotAttribute::class)->withPivot('hourly_price');
    }
}
