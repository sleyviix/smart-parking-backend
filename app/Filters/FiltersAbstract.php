<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FiltersAbstract
{
    private array $param;

    protected array $filters = [];


    public function __construct(array $param)
    {
        $this->param = $param;
    }

    public function filter(Builder $builder): Builder
    {

        foreach($this->param as $filter => $values){
            $this->resolveFilter($filter)->filter($builder, $values);
        }
        return $builder;
    }

    private function resolveFilter(string $filter)
    {
        return new $this->filters[$filter];
    }

}
