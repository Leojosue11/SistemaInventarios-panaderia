<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroMateriaPrima extends Model
{
    protected $fillable = ['CodigoMP','NombreMP','Clase','Observacion','ProveedorID','Descripcion','UnidadMedidaID']; 
    
}
