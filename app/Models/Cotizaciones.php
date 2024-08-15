<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
   use HasFactory;
   protected $table = 'cotizacion';

   public function cliente()
   {
      return $this->belongsTo(Clientes::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function cotizacionDetalles()
   {
      return $this->hasMany(CotizacionesDetalle::class, 'cotizacion_id');
   }
}
