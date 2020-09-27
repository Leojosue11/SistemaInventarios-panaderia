<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientosMP extends Model
{
    protected $fillable = ["MateriaPrimaID","Cantidad","FechaMovimiento","SucursalID"];
}
