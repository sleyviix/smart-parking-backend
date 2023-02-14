<?php

namespace App\Rules;

use App\Models\parkingSpot;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class ExistingReservationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param int $parking_spot_id
     */
    public function __construct(public int $parking_spot_id)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->parking_spot_id) {
            return false;
        }

        $result = parkingSpot::where('id', $this->parking_spot_id)->whereHas('reservations', function (Builder $query) use ($value) {
                $query->where([
                    ['start', '<=', Carbon::parse(Arr::get($value, 'end'))],
                    ['end', '>=', Carbon::parse(Arr::get($value, 'start'))],
                ]);
            })->count() == 0;

        return $result;
        }

        //



    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'A reservation for this spot already exists.';
    }
}
