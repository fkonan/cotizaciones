<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionesDetalle extends Model
{
   use HasFactory;
   protected $table = 'cotizacion_detalle';
   public $timestamps = false;

   protected $fillable = [
      'cotizacion_id',
      'producto_id',
      'cantidad',
      'valor',
      'subtotal',
      'descuento',
      'total',
      'iva',
   ];

   public function cotizacion()
   {
      return $this->belongsTo(Cotizaciones::class);
   }

   public function producto()
   {
      return $this->belongsTo(Productos::class);
   }
}
