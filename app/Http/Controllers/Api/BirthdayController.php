<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Service\UserService;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function __construct(protected UserService $user) {
        $this->middleware("auth:sanctum");
    }
    public function index() {
        $this->user->isAllowedToPerformAction("member:birthdays");

        $today = now();
        $end = now()->addDays(15);
        $members = Member::filter()
            ->orderByRaw("MONTH(date_of_birth), DAY(date_of_birth)")
            ->whereNotIn("payment_status", ["level3", "level4"])
            ->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') BETWEEN ? AND ?", [
                $today->format('m-d'),
                $end->format('m-d'),
            ])
            ->paginate(8);
        return MemberResource::collection($members);
    }
}
