<?php

namespace App\Filters\parkingSpot;

use Illuminate\Database\Eloquent\Builder;

class AttributesFilter
{
    public function filter(Builder $builder, mixed $values):Builder
    {
//        dd($values);
        // TODO: Implement filter() method.
        foreach ($values as $attribute){
            $builder->whereHas('spotAttributes', function (Builder $builder) use ($attribute){
                $builder->where('name', $attribute);
            });
        }

        return $builder;

    }

}
