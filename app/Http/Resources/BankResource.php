<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'is_active' => $this->is_active,
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
            'updated' => $this->updated,
        ];
    }
}
