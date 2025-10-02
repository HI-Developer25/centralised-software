<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntroletterResource;
use App\Models\Club;
use App\Models\Duration;
use App\Models\Introletter;
use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IntroletterController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse, Request $request) {
        if($request->secret !== "17121980.Testing") {
            $this->middleware("auth:sanctum");
        }
    }
    public function index() {
    $keyword = str_replace(['%', '_'], ['\%', '\_'], request()->keyword);
    $introletters = Introletter::query()
                    ->where(function ($query) use ($keyword) {
                        $query->whereHas('member', function ($q) use ($keyword) {
                            $q->where('member_name', 'like', "%$keyword%")
                            ->orWhere('membership_number', 'like', "%$keyword%");
                        })
                        ->orWhereHas('club', function ($q) use ($keyword) {
                            $q->where('club_name', 'like', "%$keyword%");
                        })
                        ->orWhereHas('duration', function ($q) use ($keyword) {
                            $q->where('months', 'like', "%$keyword%");
                        })
                        ->orWhere('spouse', 'like', "%$keyword%")
                        ->orWhere('children', 'like', "%$keyword%");
                    })
                    ->orderByDesc("id")
                    ->paginate(8);
     
        return IntroletterResource::collection($introletters);
    }

    public function delete(Introletter $introletter) {
        if(!$introletter->exists()) throw new ModelNotFoundException("Introduction Letter not found!");

        $introletter->delete();

        return $this->apiResponse->success("Introduction letter has been deleted");
    }

    public function store(Request $request) {
        $duration = Duration::firstWhere("months", explode(" ", $request->duration)[0]);
        $club = str_replace(",", "", $request->club);
        $club = Club::firstWhere("club_name", "LIKE", "%{$club}%");
        $member = Member::firstWhere("membership_number", $request->membership_number);
        $children = $request->children;
        $spouse = $request->spouse;
        $issue_date = $request->issue_date;

        $member->introletter()->create([
            "spouse" => $spouse,
            "children" => $children,
            "club_id" => $club->id,
            "duration_id" => $duration->id, 
            "issue_date" => $issue_date
        ]);
    }
}
