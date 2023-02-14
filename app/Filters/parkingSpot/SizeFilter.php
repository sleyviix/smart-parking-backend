<?php

namespace App\Filters\parkingSpot;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class SizeFilter implements FilterInterface
{


    public function filter(Builder $builder, mixed $values):Builder
    {
        // TODO: Implement filter() method.
//        dd($values);
        return $builder->whereHas('size', function (Builder $builder) use ($values){
            $builder->where('name', $values);
        });

    }
}
