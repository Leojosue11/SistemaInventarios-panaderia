<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrimaProveedor extends Model
{
    protected $fillable = ["ProveedorId","ProductoID","CantidadTotal","Desperdicio","FechaCaducidad","UnidadMedidaID","PrecioUnitario"];
}
