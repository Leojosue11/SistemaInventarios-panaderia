<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $primaryKey = 'IdSucursal';
    protected $fillable = ['NombreSucursal','Ubicacion','TelefonoSucursal','EncargadoID'];
}
