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
        'http://localhost/PanaderiaBG/public/Usuarios',
        'http://localhost/PanaderiaBG/public/Roles',
        'http://localhost/PanaderiaBG/public/Proveedores',
        'http://localhost/PanaderiaBG/public/ListaProveedores',
        'http://localhost/PanaderiaBG/public/MateriaPrimaProveedor',
        'http://localhost/PanaderiaBG/public/MateriaPrimaProveedor/*',
        'http://localhost/PanaderiaBG/public/Bodegas',
        'http://localhost/PanaderiaBG/public/ShowMateriaPrima',
        'http://localhost/PanaderiaBG/public/Pedido',
        'http://localhost/PanaderiaBG/public/Pedido/*',
        'http://localhost/PanaderiaBG/public/Sucursal/',
        'http://localhost/PanaderiaBG/public/Sucursales/',
        'http://localhost/PanaderiaBG/public/Sucursales/*',
        'http://localhost/PanaderiaBG/public/login',
        'http://localhost/PanaderiaBG/public/logout',
        'http://localhost/PanaderiaBG/public/TipoProveedor',
        'http://localhost/PanaderiaBG/public/Proveedores/*',
        'http://localhost/PanaderiaBG/public/Empleados',
        'http://localhost/PanaderiaBG/public/Empleados/*',
        'http://localhost/PanaderiaBG/public/Titulo',
        'http://localhost/PanaderiaBG/public/Cargo',
        'http://localhost/PanaderiaBG/public/Encargados',


    ];
}
