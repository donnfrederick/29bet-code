<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {   
      
        $request->validate([
            'locale' => 'required|string|in:en,pt,zh', // Add more supported locales if needed
        ]);

        session(['locale' => $request->locale]);
      
        return redirect()->back();
    }
}
