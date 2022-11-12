<?php

use Carbon\Carbon;

class PeriodConfig
{
    /**
     * @var array
     */
    protected array $periodMap = [];

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return $this
     */
    public function configure(Carbon $from, Carbon $to): static
    {
        $this->mapDatesToList($from, $to);
        return $this;
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     * @return void
     */
    protected function mapDatesToList(Carbon $from, Carbon $to): void
    {

        $this->setPeriodMapValue($from->dayOfYear, $from->hour, $this->calculateFactor($from, true));

        $date = $from->clone()->startOfHour()->addHour();

        while ($date->lt($to)) {
            $factor = ($date->dayOfYear !== $to->dayOfYear || $date->hour !== $to->hour) ? 1 : $this->calculateFactor($to);
            $this->setPeriodMapValue($date->dayOfYear, $date->hour, $factor);
            $date->addHour();
        }

    }

    /**
     * @param $day
     * @param $hour
     * @param $value
     * @return void
     */
    protected function setPeriodMapValue($day, $hour, $value):void
    {
        $this->periodMap[$day][$hour] = $value;
    }

    /**
     * @param Carbon $date
     * @param bool $isStartOfPeriod
     * @return float
     */
    protected function calculateFactor(Carbon $date, bool $isStartOfPeriod = false): float
    {
        $minutes = $date->minute;

        if ($isStartOfPeriod) {
            $minutes = 60 - $minutes;
        }

        $factor = $minutes / 60;

        return $factor === 0 ? 1 : $factor;
    }

    /**
     * @return array
     */
    public function getPeriodMap(): array
    {
        return $this->periodMap;
    }
}
