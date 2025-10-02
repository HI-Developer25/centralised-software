<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroletterResource extends JsonResource
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
            "full_name" => $this->member->member_name,
            "membership_number" => $this->member->membership_number,
            "spouse" => $this->spouse,
            "children" => $this->children,
            "club" => $this->club,
            "duration" => $this->duration,
            "created_at" => $this->created_at->format("d-M-Y"),
            "issue_date" => Carbon::parse($this->issue_date)->format("d-M-Y")
        ];
    }
}
