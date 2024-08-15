<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
   use HasFactory;

   public function cotizaciones()
   {
      return $this->hasMany(Cotizaciones::class);
   }
}
