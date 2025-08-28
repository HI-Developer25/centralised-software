<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildToggleController extends Controller
{
    public function toggleConversion(Request $request, Child $child) {
        $child->is_converted = $request->is_converted;
        $child->save();

        return response()->json([
            "message" => "Converted status updated successfully",
            "data" => [
                "id" => $child->id,
                "success" => true,
                "is_converted" => $child->is_converted
            ]
        ]);
    }
    public function toggleContacted(Request $request, Child $child) {
        $child->is_contacted = $request->is_contacted;
        $child->save();

        return response()->json([
            "message" => "Converted status updated successfully",
            "data" => [
                "id" => $child->id,
                "success" => true,
                "is_converted" => $child->is_contacted
            ]
        ]);
    }
}
