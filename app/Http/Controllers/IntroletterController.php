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
        dd($introletter->member);
        return view("Invoices.letter_invoice", compact("introletter"));
    }
}
