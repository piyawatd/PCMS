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
        "/admins/customer/list/*",
        "/admins/customer/delete/*",
        "/admins/categorycontent/list/*",
        "/admins/categorycontent/delete/*",
        "/admins/category/list/*",
        "/admins/category/delete/*",
        "/admins/content/list/*",
        "/admins/content/delete/*",
        "/admins/product/list/*",
        "/admins/product/delete/*",
        "/admins/content/checkAlias",
        "/admins/customer/checkEmail",
        "/admins/product/checkAlias",
        "/cart",
        "/changelanguage",
    ];
}
