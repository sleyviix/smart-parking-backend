<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class parkingSpotIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
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
            'datetime_range.start' => ['sometimes', 'date', 'after_or_equal:now'],
            'datetime_range.end' => ['sometimes', 'date', 'after:start'],
            'size' => ['nullable', 'string', 'in:small,medium,large'],
            'attributes' => ['sometimes', 'array'],
            'attributes.*' => ['required', 'string', 'in:electric,for_women,handicapped,with_kids']
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
           'datetime_range' => [
               'start' => $this->get('start'),
               'end' => $this->get('end')
           ]

        ]);
    }
}
