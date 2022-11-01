<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'bank_id' => $this->bank_id,
            'currency1' => $this->currency1,
            'currency2' => $this->currency2,
            'value' => $this->value,
            'under' => $this->under,
            'sent' => $this->sent,
            'date_sent' => $this->sent,
        ];
    }
}
