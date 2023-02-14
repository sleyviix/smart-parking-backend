<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class CalcPayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return $this->user()->can('view', Reservation::find($this->get('reservation_id')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            //
            'reservation_id' => ['required']

        ];
    }
}
