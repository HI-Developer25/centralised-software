<?php

namespace App\Http\Controllers;

use App\Models\Introletter;
use Illuminate\Http\Request;

class IntroletterController extends Controller
{
    public function index() {
        return view("Introletter.index");
    }
    public function invoice(Introletter $introletter) {
       $file_number = $introletter->member->file_number;
       $member = \DB::connection("old_mysql")->table("members_2")->where("file_no", $file_number)->first();
         dd($member);
       return view("Invoices.letter_invoice", compact("introletter"));
    }
}
