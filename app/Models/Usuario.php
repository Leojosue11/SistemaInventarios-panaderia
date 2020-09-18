<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // use Hasfactory;
    protected $fillable = ['NombreUsuario','EmailUsuario','RolId','Password']; 
}
