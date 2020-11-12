<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Empleado extends Model
{
     //setea el formato de fecha
  public function setFechaContratacionAttribute($value)
  {
    $this->attributes['FechaContratacion'] = (new Carbon($value))->format('d-m-Y');
  }
    protected $fillable = ['TituloID','NombreEmpleado','ApellidoEmpleado','DireccionEmpleado','EmailEmpleado','TelefonoEmpleado','MovilEmpleado','DUIEmpleado','GeneroEmpleado','FechaContratacion','FechaNacimiento','CargoID', 'Observaciones']; 
}
