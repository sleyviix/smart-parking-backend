<?php

use Carbon\Carbon;

class PriceCalculator
{
    protected PriceConfig $priceConfig;
    protected PeriodConfig $periodConfig;

    protected array $periodMap = [];
    protected array $config = [];

    protected int $calculatedPrice = 0;

    public function setPriceConfigurator(PriceConfig $priceConfig): self
    {

        $this->priceConfig = $priceConfig;

        return $this;
    }

    public function setPeriodConfigurator(PeriodConfig $periodConfig): self
    {
        $this->periodConfig = $periodConfig;

        return $this;
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return int
     */
    public function calculate(Carbon $from, Carbon $to): int
    {
        $this->periodMap = $this->periodConfig->configure($from, $to)->getPeriodMap();

        $this->config = $this->priceConfig->getConfig();

        $this->calculatePrice($from);

        return $this->calculatedPrice;
    }

    private function calculatePrice(Carbon $start): void
    {
        $this->calculatedPrice = collect($this->periodMap)->map(function ($hours, $dayOfYear) use ($start) {
            return array_intersect_key(
                Arr::get($this->config, $start->startOfYear()->subDay()->addDays($dayOfYear)->dayOfWeekIso), $hours
            );
        })->map(function ($hourlyPrices, $dayOfYear) {
            return collect($hourlyPrices)->map(function ($price, $hour) use ($dayOfYear) {
                return $price * $this->periodMap[$dayOfYear][$hour];
            })->sum();
        })->sum();
    }

}
