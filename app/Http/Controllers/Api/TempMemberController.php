<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThirtyPlusMemberResource;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Child;

class TempMemberController extends Controller
{
    public function index() {
        $members = Member::filter()->whereHas("children", function($query) {
            $query->whereDate(
                "date_of_birth",
                "<=",
                Carbon::now()->subYears(30)
            );
        })->paginate(30);
        
        return ThirtyPlusMemberResource::collection($members);
    }
}
