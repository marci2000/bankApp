<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
            'bankName' => ['required', 'max:255'],
            'currency1' => ['required', 'max:3'],
            'currency2' => ['required', 'max:3'],
            'value' => ['required', 'numeric'],
            'under' => ['required', 'boolean'],
        ];
    }
}
