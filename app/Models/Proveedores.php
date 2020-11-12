<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $fillable = ['CodigoProveedor','NombreProveedor','TipoProveedorID','TelefonoProveedor','MovilProveedor','EmailProveedor','FaxProveedor','NITProveedor','NIDFiscal','TituloProveedor']; 
}
