<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempMemberController extends Controller
{
    public function index() {
        return view("members.temp");
    }
}
