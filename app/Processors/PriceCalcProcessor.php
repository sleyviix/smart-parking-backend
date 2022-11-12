<?php

namespace App\Processors;

    use App\Models\Reservation;
    use PeriodConfig;
    use PriceCalculator;
    use PriceConfig;

    class PriceCalcProcessor
    {
        protected PriceConfig $priceConfig;
        protected PeriodConfig $periodConfig;
        protected PriceCalculator $priceCalculator;

        public function __construct()
        {
            $this->priceCalculator = new PriceCalculator();
            $this->periodConfig = new PeriodConfig();
            $this->priceConfig = new PriceConfig();
        }

        public function process(int $reservationId): int
        {
            $reservation = Reservation::findOrFail($reservationId);

            $parkingSpot = Reservation::findOrFail($reservationId)->parkingSpots;

            $parkingPlaces = $parkingSpot->parkingSpotAttributes();

            $priceAttributes = $parkingPlaces->whereIn('parking_spot_attributes.id', $parkingPlaces->pluck('id')->toArray())
                                                ->get()->sum('pivot.hourly_price');

            $basePrice = $parkingSpot->parkingPlaces->parkingPrices->where('size_id', $parkingSpot->size_id)->first();

            $result = $this->priceCalculator->setPeriodConfigurator($this->periodConfig->configure($reservation->start, $reservation->end))
                                            ->setPriceConfigurator($this->priceConfig->setBasePrice($basePrice->basePrice + $priceAttributes))
                                                ->calculate($reservation->start, $reservation->end);
            return $result;
        }

    }
