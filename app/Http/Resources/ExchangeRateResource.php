<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'bank' => $this->bank->name,
            'currency1' => $this->currency1,
            'currency2' => $this->currency2,
            'value' => $this->value,
            'date' => $this->date
        ];
    }
}
