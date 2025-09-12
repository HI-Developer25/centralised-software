<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\CreateFamilySheet;
use App\Models\Member;
use App\Models\Spouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SpouseController extends Controller
{
    public function store(Request $request) {
         $validated = $request->validate([
            'spouse_name' => 'required|string|max:255',
            'member_id' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_issue' => 'required|date',
            'validity' => 'required|date',
            'blood_group' => 'required',
            'cnic' => 'required',
            'emergency_number' => 'nullable|string|max:255',
            'emergency_country_code' => 'nullable|string|max:10',
            'emergency_phone_number' => 'nullable|string|max:20',
            'picture' => 'nullable|image|max:2048', // 2MB limit
        ]);

        if ($request->hasFile('picture')) {
            $directory = "uploads/spouse_pictures";
            $fileName = $request->spouse_name . "_" . time() . "." . $request->picture->extension();
                
            Storage::disk("public")->putFileAs($directory, $request->picture, $fileName);
            $filePath = $directory . "/" . $fileName;
            
            $validated['picture'] = $filePath;
        } else {
            $validated["picture"] = "profile_pictures/default-user.png";
        }

        // Save to DB (example)
        $spouse = Spouse::create($validated);

        $member = Member::find($request->member_id);
        dispatch(new CreateFamilySheet($member));
    
        return response()->json([
            'message' => 'Spouse created successfully!',
            'data' => $spouse
        ]);
    }

    public function delete(Spouse $spouse) {
        $member_id = $spouse->member_id;
        $spouse->delete();
        
        $member = Member::find($member_id);
        dispatch(new CreateFamilySheet($member));
        

        return response()->json([
            "Message" => "Successfully Divorced!",
            'data' => $spouse
        ]);
    }
}
