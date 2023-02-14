<?php

namespace App\Models;

use App\Filters\parkingSpot\parkingSpotFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class parkingSpot extends Model
{

    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return belongsToMany
     */
    public function SpotAttributes():belongsToMany
    {
        return $this->belongsToMany(SpotAttribute::class);
    }

    public function parkingPlace(): BelongsTo
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

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return (new parkingSpotFilters($filters))->filter($query);

//        $query->when(Arr::has($filters, ['start', 'end']), function (Builder $query) use ($filters) {
//
//        });
    }
}
