<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\productsCsrfToken as Middleware;

class productsCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
