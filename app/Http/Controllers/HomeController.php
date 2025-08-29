<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Club;
use App\Models\Member;
use App\Models\RecoverySheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $members_monthly = Member::whereMonth('created_at', Carbon::now()->month)->count();
        $recent_member = Member::latest()->limit(1)->first();
        $total_clubs = Club::count();
        $famous_club = Club::withCount("introletters")
                                ->orderByDesc("introletters_count")
                                ->limit(1)
                                ->first();
        
        $today = now();

        $memberships = CardType::withCount("members", "spouses", "children")
                                ->get();
        
        $lastYear = now()->subYear();
        $currentYear = now()->year;
                    
        $currentYearRecoverySheetPayable = RecoverySheet::selectRaw("SUM(payable) AS payable, MONTH(month)")
                                            ->whereYear("month", ">=", $currentYear)
                                            ->whereYear("due_date", "<=", $currentYear)
                                            ->groupByRaw("MONTH(month)")
                                            ->get();

        $currentYearRecoverySheetPaid = RecoverySheet::selectRaw("SUM(paid) AS paid, MONTH(month)")
                                            ->whereYear("month", ">=", $currentYear)
                                            ->whereYear("due_date", "<=", $currentYear)
                                            ->groupByRaw("MONTH(month)")
                                            ->get();

        $currentYearRecoverySheetPayable->map(function($year) {
            if($year->paid === null) {
                $year->paid = 0;
            }
            return $year;
        });

        $currentYearRecoverySheetPaid->map(function($year) {
            if($year->paid === null) {
                $year->paid = 0;
            }
            return $year;
        });

        return view("dashboard", compact("members_monthly", "total_clubs", "famous_club", "recent_member", "memberships", "currentYearRecoverySheetPayable", "currentYearRecoverySheetPaid"));
    }
}
