<?php

namespace App\Filters\parkingSpot;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class DatetimeFilter
{
    public function filter(Builder $builder, mixed $values):Builder
    {
//        dd($values);
        // TODO: Implement filter() method.
        return $builder->whereDoesntHave('reservations', function (Builder $query) use ($values) {
            $query->where([
                ['start', '<=', Carbon::parse(Arr::get($values, 'end'))],
                ['end', '>=', Carbon::parse(Arr::get($values, 'start'))],
            ]);
        });

    }

}
