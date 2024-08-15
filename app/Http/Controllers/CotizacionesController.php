<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Cotizaciones;
use App\Models\Productos;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CotizacionesController extends Controller
{
   public function index()
   {
      return view('cotizaciones.index');
   }

   public function getAll()
   {
      $datos = Cotizaciones::with('cliente', 'cotizacionDetalles', 'cotizacionDetalles.producto')->get();
      return response()->json($datos);
   }

   public function nueva()
   {
      try {
         $clientes = Clientes::all();
         $productos = Productos::all();

         return view('cotizaciones.nueva', compact('clientes', 'productos'));
      } catch (\Exception $e) {
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function store(Request $request)
   {
      try {

         $productos = $request->get('productos', []);
         $descuento = 0;
         $subtotal = 0;

         foreach ($productos as $producto) {
            $descuento += $producto['descuento'];
            $subtotal += $producto['subtotal'];
         }
         $cotizacion = new Cotizaciones();
         $cotizacion->cliente_id = $request->cliente_id;
         $cotizacion->user_id = auth()->user()->id;
         $cotizacion->fecha = date('Y-m-d');
         $cotizacion->descuento = $descuento;
         $cotizacion->subtotal = $subtotal;
         $cotizacion->total = $subtotal - $descuento;
         $cotizacion->save();

         foreach ($productos as $producto) {
            $cotizacion->cotizacionDetalles()->create([
               'producto_id' => $producto['producto_id'],
               'cantidad' => $producto['cantidad'],
               'valor' => $producto['valor'],
               'subtotal' => $producto['subtotal'],
               'descuento' => $producto['descuento'] ? $producto['descuento'] : 0,
               'total' => $producto['total'],
               'iva' => 0,
            ]);
         }

         $pdf = PDF::loadView('cotizaciones.pdf', [
            // 'cotizacion' => 111111,
            'cotizacion' => $cotizacion->id,
            'productos' => $productos,
            'cliente' => $cotizacion->cliente->nombres . ' ' . $cotizacion->cliente->apellidos,
            'fecha' => $cotizacion->fecha,
            'descuento' => $descuento,
            'subtotal' => $subtotal,
            'total' => $subtotal - $descuento,

         ]);

         $pdfPath = 'cotizaciones/cotizacion_' . $cotizacion->id . '.pdf';
         Storage::disk('public')->put($pdfPath, $pdf->output());

         // Actualiza la cotización con la ruta del PDF
         $cotizacion->pdf = $pdfPath;
         $cotizacion->save();


         return response()->json(['success' => true, 'message' => 'Cotización guardada correctamente'], 200);
      } catch (\Exception $e) {
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }
}
