<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'bank' => $this->bank->name,
            'currency1' => $this->currency1,
            'currency2' => $this->currency2,
            'under' => $this->under == 1,
            'email_is_sent' => $this->sent == 1,
            'date_sent' => $this->date_sent,
        ];
    }
}
