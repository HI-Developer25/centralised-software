<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TempMemberController extends Controller
{
    public function index() {
        return view("Members.temp");
    }
    
    public function generatePDF() {
        // Get the same data that the API returns for the table
        $members = \App\Models\Member::filter()->whereHas("children", function($query) {
            $query->whereDate(
                "date_of_birth",
                "<=",
                \Carbon\Carbon::now()->subYears(30)
            );
        })->with(['children', 'membership'])->get();
        
        // Transform data to match the PDF template expectations
        $transformedMembers = $members->map(function($member) {
            return [
                'member_name' => $member->member_name,
                'contact_number' => $member->phone_number,
                'address' => $member->residential_address,
                'email' => $member->email_address,
                'alternate_ph_number' => $member->alternate_ph_number,
                'membership_type' => $member->membership ? $member->membership->card_name : 'Unknown',
                'profile_picture' => $member->profile_picture,
                'children' => $member->children->filter(function($child) {
                    // Only include children who are 30+ years old (same filter as table)
                    return \Carbon\Carbon::parse($child->date_of_birth)->age >= 30;
                })->map(function($child) {
                    return [
                        'child_name' => $child->child_name,
                        'date_of_birth' => $child->date_of_birth,
                        'profile_pic' => $child->profile_pic,
                    ];
                })->toArray()
            ];
        });
        
        $pdf = Pdf::loadView('Members.temp_pdf', [
            'tempMembers' => $transformedMembers
        ])
        ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->setPaper('A4', 'portrait');
        
        return $pdf->download('temp_members_report_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
