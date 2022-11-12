<?php

class PriceConfig
{

    protected array $config;
    protected int $amount;

//    public function __construct(protected int $amount = 0)
//    {
//        $this->amount = $amount;
//        $this->setBasePrice($this->amount);
//
//    }

    /**
     * @param array $additionalConfig
     * @return void
     */
    public function  addConfig(array $additionalConfig):self
    {
        foreach ($additionalConfig as $config){
            if (!Arr::has($config, 'amount')){
                Arr::set($config, 'amount', $this->amount);
            }

            $this->configure(
              Arr::get($config, 'amount'),
              Arr::get($config, 'days'),
              Arr::get($config, 'hours'),
            );
        }
        return $this;

    }

    /**
     * @return int
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    private function configure(int $amount, array $days = null, string $configHours = null):void
    {
        $hours = null;

        if (is_string($configHours)){
            $hours = $this->prepareHours($configHours);
        }

        if (is_null($hours)){
            $hours = range(0, 23);

        }

        if (empty($days)){
            $days = range(1, 7);

        }

        collect($days)->each(function ($day) use ($hours, $amount){
            collect($hours)->each(function ($hour) use ($day, $amount){
               $this->config[$day][$hour] = $amount;
            });
        });
    }

    private function prepareHours(string $hours):array
    {
//        [$start, $end] = explode('-', $hours);

        $start = explode('-', $hours);
        $end = explode('-', $hours);

        return range($start, $end);
    }

    public function resetConfig(): void
    {

        $this->setBasePrice($this->amount);
    }

    public function setBasePrice(int $amount): self
    {
        $this->amount = $amount;

        $this->configure($amount);

        return $this;
    }

//    private function setDefaultConfig(int $amount):void
//    {
//        $this->configure($amount);
//    }
}
