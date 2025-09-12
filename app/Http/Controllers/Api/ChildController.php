<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateFamilySheet;
use App\Models\Child;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'child_name' => 'required|string|max:255',
            'member_id' => 'required',
            'membership_id' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_issue' => 'required|date',
            'validity' => 'required|date',
            'blood_group' => 'required',
            'cnic' => 'required',
            'emergency_number' => 'nullable|string|max:255',
            'emergency_country_code' => 'nullable|string|max:10',
            'emergency_phone_number' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

    if ($request->hasFile('profile_pic')) {
        $directory = "uploads/children_pictures";
        $fileName = $request->child_name . "_" . time() . "." . $request->profile_pic->extension();
            
        Storage::disk("public")->putFileAs($directory, $request->profile_pic, $fileName);
        $filePath = $directory . "/" . $fileName;
           
        $validated['profile_pic'] = $filePath;
    } else {
        $validated["profile_pic"] = "profile_pictures/default-user.png";
    }

    // Save to DB (example)
    $child = Child::create($validated);

    $member = Member::find($request->member_id);
    dispatch(new CreateFamilySheet($member));

    return response()->json([
        'message' => 'Child created successfully!',
        'data' => $child
    ]);
    }
    public function delete(Child $child) {
        $member_id = $child->member_id;
        $child->delete();

        $member = Member::find($member_id);
        dispatch(new CreateFamilySheet($member));

        return response()->json([
            'message' => 'Child',
            'data' => $child
        ]);
    }
}
