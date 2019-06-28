<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string encrypted
 * @property string expire
 */
class CreatePastRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {

        return [
            'encrypted' => ['required', 'string'],
            'expire'    => ['required', 'in:5m,1h,1d,1w,1m,1y']
        ];
    }
}
