<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [ 
        '/webpay/{order}/return/{worker}',  //Agregar esta línea. Cambiar a tu ruta
        '/webpay/{order}/final/{worker}', //Agregar esta línea. Cambiar a tu ruta
    ];
}
