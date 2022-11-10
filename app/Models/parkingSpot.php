<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class parkingSpot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return belongsToMany
     */
    public function parkingSpotAttributes():belongsToMany
    {
        return $this->belongsToMany(parkingSpotAttribute::class);
    }

    public function parkingPlaces(): BelongsTo
    {
        return $this->belongsTo(parkingPlace::class);
    }

    public function reservations(): hasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function size():BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when(Arr::has($filters, ['start', 'end']), function (Builder $query) use ($filters) {
            $query->whereDoesntHave('reservations', function (Builder $query) use ($filters) {
                $query->where([
                    ['start', '<=', Carbon::parse(Arr::get($filters, 'end'))],
                    ['end', '>=', Carbon::parse(Arr::get($filters, 'start'))],
                ]);
            });
        });
    }
}
