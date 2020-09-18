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
        'http://localhost/PanaderiaBG/public/MateriaPrima',
        'http://localhost/PanaderiaBG/public/MateriaPrima/*',
        'http://localhost/PanaderiaBG/public/UnidadMateria',
        'http://localhost/PanaderiaBG/public/ProveedorMateria',
        'http://localhost/PanaderiaBG/public/MateriaPrimaProveedor'

    ];
}
