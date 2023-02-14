<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reservation extends Model
{


    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'start',
        'end',
        'paid_at',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function parkingSpot(): BelongsTo
    {
//        return $this->belongsTo(parkingSpot::class, 'spot_id');
        return $this->belongsTo(parkingSpot::class);
    }
}
