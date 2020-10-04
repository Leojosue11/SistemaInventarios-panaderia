<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MovimientosMP extends Model
{
    //setea el formato de fecha
    public function setFechaMovimientoAttribute( $value ) {
        $this->attributes['FechaMovimiento'] = (new Carbon($value))->format('d-m-Y');
      } 
    protected $fillable = ["MateriaPrimaID","Cantidad","FechaMovimiento","SucursalID"];
}
