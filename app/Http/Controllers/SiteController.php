<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    
    public function sports() {
        return view('pages.sports');
    }
}
