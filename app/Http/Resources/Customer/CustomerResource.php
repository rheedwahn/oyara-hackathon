<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id' => $this->id,
            'accountNumber' => $this->accountNumber,
            'accountName' => $this->accountName,
            'currency' => $this->currency,
            'accountOpeningDate' => date('Y-m-d', strtotime($this->accountOpeningDate)),
            'lastTransactionDate' => date('Y-m-d', strtotime($this->lastTransactionDate)),
            'accountType' => $this->accountType,
            'bvn' => $this->bvn,
            'fullname' => $this->fullname,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email,
            'status' => $this->status
        ];
    }
}
