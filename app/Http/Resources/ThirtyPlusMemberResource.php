<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ThirtyPlusMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "member_name" => $this->member_name,
            "profile_picture" => $this->profile_picture,
            "age" => "1 Years",
            "contact_number" => $this->phone_number_code . " " . Str::replaceFirst("+", "", $this->phone_number),
            "address" => wordwrap($this->residential_address, 25, "<br>", true),
            "membership_type" => "Permanent",
            "children" => $this->thirtyPlusChildren,
            "is_converted" => true,
            "is_contacted" => $this->is_contacted,
            "email" => $this->email_address
        ];
    }
}
