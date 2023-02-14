<?php

namespace App\Filters\parkingSpot;

use App\Filters\FiltersAbstract;
use PHPUnit\Framework\Constraint\Attribute;

class parkingSpotFilters extends FiltersAbstract
{
    protected array $filters = [
        'size' => SizeFilter::class,
        'attributes' => AttributesFilter::class,
        'datetime_range' => DatetimeFilter::class
    ];

}
