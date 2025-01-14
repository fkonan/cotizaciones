<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Cotizaciones;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
   public function index()
   {
      return view('clientes.index');
   }

   public function store(Request $request)
   {
      try {
         $datos = Clientes::where('documento', $request->documento)->get();
         if (count($datos) > 0) {
            return response()->json(['success' => false, 'message' => 'El documento ya se encuentra registrado'], 200);
         }
         $cliente = new Clientes();
         $cliente->tipo_doc = $request->tipo_doc;
         $cliente->documento = $request->documento;
         $cliente->div = $request->div;
         $cliente->nombres = $request->nombres;
         $cliente->apellidos = $request->apellidos;
         $cliente->razon_social = $request->razon_social;
         $cliente->correo = $request->correo;
         $cliente->telefono = $request->telefono;
         $cliente->direccion = $request->direccion;
         $cliente->contacto = $request->contacto;
         $cliente->status = 1;
         if ($cliente->save())
            return response()->json(['success' => true, 'message' => 'Registro creado exitosamente'], 200);
         else
            return response()->json(['success' => false, 'message' => 'No se pudo crear el registro'], 500);
      } catch (\Exception $e) {
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function edit($id)
   {
      $datos = Clientes::find($id);
      if ($datos) {
         return response()->json(['datos' => $datos], 200);
      } else {
         return response()->json(['datos' => null, 'message' => 'No se encontro el registro'], 404);
      }
   }

   public function update(Request $request, $id)
   {
      $datos = Clientes::where('documento', $request->documento)->where('id', '!=', $id)->get();
      if (count($datos) > 0) {
         return response()->json(['success' => false, 'message' => 'El documento ya se encuentra registrado'], 200);
      }
      if ($cliente = Clientes::find($id)) {

         $cliente->tipo_doc = $request->tipo_doc;
         $cliente->documento = $request->documento;
         $cliente->div = $request->div;
         $cliente->nombres = $request->nombres;
         $cliente->apellidos = $request->apellidos;
         $cliente->razon_social = $request->razon_social;
         $cliente->correo = $request->correo;
         $cliente->telefono = $request->telefono;
         $cliente->direccion = $request->direccion;
         $cliente->contacto = $request->contacto;
         $cliente->save();
         return response()->json(['success' => true, 'message' => 'Registro actualizado correctamente'], 200);
      } else {
         return response()->json(['success' => false, 'message' => 'No se encontro el registro'], 404);
      }
   }

   public function destroy($id)
   {
      try {
         $cliente = Clientes::find($id);
         $cotizacion = Cotizaciones::where('cliente_id', $id)->get();
         if (count($cotizacion) > 0) {
            return response()->json(['success' => false, 'message' => 'No se puede eliminar el cliente, tiene cotizaciones asociadas.'], 200);
         }
         $cliente->delete();
         return response()->json(['success' => true, 'message' => 'Registro eliminado exitosamente'], 200);
      } catch (\Exception $e) {
         // Captura cualquier excepción y devuelve una respuesta de error
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function getAll()
   {
      $clientes = Clientes::where('status', 1)->get();
      return response()->json($clientes);
   }
}
