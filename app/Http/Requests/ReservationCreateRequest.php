<?php

namespace App\Http\Requests;

use App\Rules\ExistingReservationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReservationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'start' => ['required', 'date', 'after_or_equal:now'],
            'end' => ['required', 'date', 'after:start'],
            'parking_spot_id' => ['required'],
            'range' =>[new ExistingReservationRule($this->get('parking_spot_id'))]
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'range'=>
                ['start' => $this->get('start'),
                    'end'=>$this->get('end')]]);
    }
}
