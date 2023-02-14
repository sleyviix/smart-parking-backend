<?php

namespace App\Processors;

    use App\Models\Reservation;
    use App\Modules\Pricing\PeriodConfig;
    use App\Modules\Pricing\PriceCalculator;
    use App\Modules\Pricing\PriceConfig;

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

//        public function process(int $reservationId): int
//        {
//            $reservation = Reservation::findOrFail($reservationId);
//
//            $parkingSpot = $reservation->parkingSpot;
//
//            $parkingPlaces = $parkingSpot->SpotAttributes;
//
//            $priceAttributes = $parkingPlaces->whereIn('parking_place_spot_attributes.id', $parkingPlaces->pluck('id')->toArray())
//                                                ->get()->sum('pivot.hourly_price');
//
//            $basePrice = $parkingSpot->parkingPlaces->parkingPrices->where('size_id', $parkingSpot->size_id)->first();
//
//            $result = $this->priceCalculator->setPeriodConfigurator($this->periodConfig->configure($reservation->start, $reservation->end))
//                                            ->setPriceConfigurator($this->priceConfig->setBasePrice($basePrice->basePrice + $priceAttributes))
//                                                ->calculate($reservation->start, $reservation->end);
//            return $result;
//        }


//        public function process(int $reservationId): int
//        {
//            $reservation = Reservation::findOrFail($reservationId);
//
//            $parkingSpot = $reservation->parkingSpot;
//
////            dd($parkingSpot);
//
//            $attributesPrice = $parkingSpot
//                ->parkingPlace
//                ->spotAttributes()
//                ->whereIn('parking_place_spot_attribute.id', $parkingSpot->spotAttributes->pluck('id')->toArray())
//                ->get()
//                ->sum('pivot.hourly_price');
//
//            return $this
//                ->priceCalculator
//                ->setPeriodConfigurator(
//                    $this->periodConfig->configure($reservation->start, $reservation->end)
//                )
//                ->setPriceConfigurator(
//                    $this->priceConfig->setBasePrice(
//                        $parkingSpot->parkingPlace->parkingPrices()->where('size_id', $parkingSpot->size_id)->first()->basePrice + $attributesPrice
//                    )
//                )
//                ->calculate(
//                    $reservation->start,
//                    $reservation->end
//                );
//        }

//        public function process(int $reservationId): int
//        {
//            $reservation = Reservation::findOrFail($reservationId);
//
//            $parkingSpot = $reservation->parkingSpot;
//
//            $attributesPrice = $parkingSpot
//                ->parkingPlace
//                ->spotAttributes()
//                ->whereIn('parking_place_spot_attribute.id', $parkingSpot->spotAttributes->pluck('id')->toArray())
//                ->get()
//                ->sum('pivot.hourly_price');
//
//            $start = $reservation->start;
//            $end = $reservation->end;
//            $hours = ($end->timestamp - $start->timestamp) / 3600;
//            $price = $hours * $attributesPrice;
//
//            $basePrice = $parkingSpot->parkingPlace->parkingPrices()->where('size_id', $parkingSpot->size_id)->first()->basePrice;
//            $finalPrice = $price + $basePrice;
//
//            return $finalPrice;
//        }



        public function process(int $reservationId): int
        {
            $reservation = Reservation::findOrFail($reservationId);

            $parkingSpot = $reservation->parkingSpot;
            $parkingPlace = $parkingSpot->parkingPlace;

            $basePrice = $parkingPlace->parkingPrices()->where('size_id', $parkingSpot->size_id)->first()->basePrice;

            return $this->priceCalculator->setPeriodConfigurator(
                $this->periodConfig->configure($reservation->start, $reservation->end)
            )->setPriceConfigurator(
                $this->priceConfig->setBasePrice(
                    $basePrice
                )
            )->calculate(
                $reservation->start,
                $reservation->end
            );
        }





    }
