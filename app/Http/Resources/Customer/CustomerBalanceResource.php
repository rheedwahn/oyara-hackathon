<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'availableBalance' => $this->availableBalance,
            'clearedBalance' => $this->clearedBalance,
            'unclearBalance' => $this->unclearBalance,
            'holdBalance' => $this->holdBalance,
            'minimumBalance' => $this->minimumBalance
        ];
    }
}
