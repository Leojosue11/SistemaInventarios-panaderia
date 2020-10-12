<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MateriaPrimaProveedor extends Model
{
  //use HasFactory;




  //setea el formato de fecha
  public function setFechaCaducidadAttribute($value)
  {
    $this->attributes['FechaCaducidad'] = (new Carbon($value))->format('d-m-Y');
  }
  protected $primaryKey = 'IDMatPrimaProveedor';
  protected $fillable = ["ProveedorId", "BodegaID", "CantidadTotal", "Desperdicio", "FechaCaducidad", "UnidadMedidaID","MateriaPrimaID", "PrecioUnitario", ];
}
