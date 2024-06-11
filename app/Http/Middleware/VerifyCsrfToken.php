<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // TEST PG
        '/api/testgame/VerifySession',
        '/api/testgame/Cash/Get',
        '/api/testgame/Cash/Transfer',
        '/api/testgame/Cash/Adjustment',

        // PROD PG
        '/api/pggame/VerifySession',
        '/api/pggame/Cash/Get',
        '/api/pggame/Cash/Transfer',
        '/api/pggame/Cash/Adjustment',
        '/api/slotegrator/SlotegratorApi'
    ];
}
