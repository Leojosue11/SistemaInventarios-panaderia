<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $primaryKey = 'IdPedido';
    protected $fillable = ["RegistroMPID","CantidadPedido","DescripcionPedido","BodegaID","SucursalID"];
}
