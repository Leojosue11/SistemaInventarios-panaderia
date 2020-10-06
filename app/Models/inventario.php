<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $fillable =['RegistroMPID','Disponible','BodegaID','FechaIngreso'];
}
