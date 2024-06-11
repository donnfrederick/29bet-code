<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function validateToken($token) {

        $user = User::where('guid', $token)->get();

        if (!$user->isEmpty()) {
            $user = $user->first();

            if (!$this->isLocked($user)) {
                return $user;
            } else return false;
        } else return false;
    }

    public function validateName($name) {
        $user = User::where('username', $name)->get();

        if (!$user->isEmpty()) {
            $user = $user->first();

            if (!$this->isLocked($user)) {
                return $user;
            } else return false;
        } else return false;
    }

    private function isLocked($user) {
        if ($user->status_lock == 0) {
            return false;
        } else {
            return true;
        }
    }
}

?>
