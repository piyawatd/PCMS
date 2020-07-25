<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admins/customer/delete/*",
        "/admins/categorycontent/delete/*",
        "/admins/category/delete/*",
        "/admins/content/delete/*",
        "/admins/product/delete/*",
        "/admins/content/checkAlias",
        "/admins/customer/checkEmail",
        "/admins/product/checkAlias",
        "/cart",
        "/changelanguage",
    ];
}
