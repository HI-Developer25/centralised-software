<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class ParentToggleController extends Controller
{
    public function toggleContacted(Member $member) {
        $member->is_contacted = !$member->is_contacted;
        $member->save();

        return response()->json([
            "message" => "Converted status updated successfully",
            "data" => [
                "id" => $member->id,
                "success" => true,
                "is_contacted" => $member->is_contacted
            ]
        ]);
    }
}
