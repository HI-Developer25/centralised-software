<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Spouse;
use App\Models\Child;

class MembersCardController extends Controller
{
    public function index() {
        $members = request()->members;
        $member_collection = collect();
        foreach($members as $member) {

            // It member key doesn't contain '-'; then it means that member is pure
            if(!str_contains($member, "-")) {
                $member = Member::find($member);
                $member_collection->push(
                    [
                        "id" => $member->id, 
                        "membership_number" => $member->membership_number,
                        "card_color" => $member->membership->card_color, 
                        "shade_color" => $member->membership->shade_color,
                        "card_type" => $member->card_type,
                        "card_name" => $member->membership->card_name,
                        "member_name" => $member->member_name
                    ]
                );
            } else {
                [$type, $id] = explode("-", $member);
                if($type === "spouse") {
                    $type = \App\Models\Spouse::class;
                    $member = $type::find($id);
                    $member_collection->push([
                        "id" => "spouse" . $member->id,
                        "membership_number" => $member->member->membership_number,
                        "card_color" => $member->member->membership->card_color,
                        "shade_color" => $member->member->membership->shade_color,
                        "card_type" => $member->member->card_type,
                        "card_name" => $member->member->membership->card_name,
                        "member_name" => $member->spouse_name
                    ]);
                } else {
                    $type = \App\Models\Child::class;
                    $member = $type::find($id);
                    $age = \Carbon\Carbon::parse($member->date_of_birth)->diffInYears();
                    $card = null;
                    $card = CardType::find($member->membership_id);
                    $member_collection->push([
                        "id" => "child" . $member->id,
                        "membership_number" => $member->member->membership_number,
                        "card_color" => $card->card_color,
                        "shade_color" => $card->shade_color,
                        "card_type" => $member->member->card_type,
                        "card_name" => $card->card_name,
                        "member_name" => $member->child_name
                    ]);
                }
            }
            
        }
        return view("Cards.front", compact("member_collection"));
    }
    public function back() {
        $members = request()->members;
        $member_collection = collect();
        foreach($members as $member) {

            // It member key doesn't contain '-'; then it means that member is pure
            if(!str_contains($member, "-")) {
                $member = Member::find($member);
                $member_collection->push(
                    [
                        "id" => $member->id, 
                        "membership_number" => $member->membership_number,
                        "card_color" => $member->membership->card_color, 
                        "shade_color" => $member->membership->shade_color,
                        "card_type" => $member->card_type,
                        "card_name" => $member->membership->card_name,
                        "member_name" => $member->member_name,
                        "cnic_passport" => $member->cnic_passport,
                        "blood_group" => $member->blood_group,
                        "emergency_contact" => $member->emergency_contact,
                        "date_of_issue" => $member->date_of_issue,
                        "validity" => $member->validity,
                        "profile_picture" => $member->profile_picture
                    ]
                );
            } else {
                [$type, $id] = explode("-", $member);
                if($type === "spouse") {
                    $type = \App\Models\Spouse::class;
                    $member = $type::find($id);
                    $member_collection->push([
                        "id" => "spouse" . $member->id,
                        "membership_number" => $member->member->membership_number,
                        "card_color" => $member->member->membership->card_color,
                        "shade_color" => $member->member->membership->shade_color,
                        "card_type" => $member->member->card_type,
                        "card_name" => $member->member->membership->card_name,
                        "member_name" => $member->spouse_name,
                        "cnic_passport" => $member->cnic,
                        "blood_group" => $member->blood_group,
                        "emergency_contact" => $member->member->emergency_contact,
                        "date_of_issue" => $member->date_of_issue,
                        "validity" => $member->validity,
                        "profile_picture" => $member->picture
                    ]);
                } else {
                    $type = \App\Models\Child::class;
                    $member = $type::find($id);
                    $age = \Carbon\Carbon::parse($member->date_of_birth)->diffInYears();
                    $card = null;
                    $card = CardType::find($member->membership_id);
                
                    $member_collection->push([
                        "id" => "child" . $member->id,
                        "membership_number" => $member->member->membership_number,
                        "card_color" => $card->card_color,
                        "shade_color" => $card->shade_color,
                        "card_type" => $member->member->card_type,
                        "card_name" => $card->card_name,
                        "member_name" => $member->child_name,
                        "cnic_passport" => $member->cnic,
                        "blood_group" => $member->blood_group,
                        "emergency_contact" => $member->member->emergency_contact,
                        "date_of_issue" => $member->date_of_issue,
                        "validity" => $member->validity,
                        "profile_picture" => $member->profile_pic
                    ]);
                }
            }   
        }
        $member_collection = $member_collection->chunk(2)->map(fn($chunk) => $chunk->reverse())->flatten(1);
        
        return view("Cards.back", compact("member_collection"));
    }
}
