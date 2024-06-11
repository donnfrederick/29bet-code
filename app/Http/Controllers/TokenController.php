<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller {
    public function Verify(Request $request) {
        if (Auth::user()->api_token == $request->token) return response()->json([], 200);
        else return response()->json([], 500);
    }

    public static function VerifyToken(Request $request, $tkn) {
        if ($tkn != csrf_token()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }
    }

    public static function generateUniqueString($baseString, $salt = null) {
        if ($salt == null) $salt = bin2hex(random_bytes(16));

        $uniqueString = hash('sha256', $baseString . $salt);

        return $uniqueString . '2eAE101' . $salt;
    }

    public static function validateHash($hash, $base) {
        $parts = explode('2eAE101', $hash);

        if (count($parts) > 1) {
            $storedSalt = $parts[1];
            $reGeneratedUniqueString = hash('sha256', $base . $storedSalt);

            if ($hash == $reGeneratedUniqueString . '2eAE101' . $storedSalt) {
                return true;
            } else return false;
        } else return false;
    }
}
