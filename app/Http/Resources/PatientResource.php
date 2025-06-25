<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'dob' => $this->dob,
            'mob_ext' => $this->mob_ext,
            'gender' => $this->gender,
            'profession' => $this->profession,
        ];
    }
    public function with($request)
    {
        return [
            'status' => 'success',
            'code' => 200
        ];
    }
}
