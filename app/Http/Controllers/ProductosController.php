<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
   public function index()
   {
      return view('productos.index');
   }

   public function store(Request $request)
   {
      try {
         $datos = new Productos();
         $datos->producto = $request->producto;
         $datos->valor = $request->valor;

         if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/productos'), $fileName);
            $datos->foto = $fileName;
         } else {
            return response()->json(['success' => false, 'message' => 'No se ha seleccionado ninguna imagen'], 400);
         }

         if ($datos->save())
            return response()->json(['success' => true, 'message' => 'Registro creado exitosamente'], 200);
         else
            return response()->json(['success' => false, 'message' => 'No se pudo crear el registro'], 500);
      } catch (\Exception $e) {
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function edit($id)
   {
      $datos = Productos::find($id);
      if ($datos) {
         return response()->json(['datos' => $datos], 200);
      } else {
         return response()->json(['datos' => null, 'message' => 'No se encontro el registro'], 404);
      }
   }

   public function update(Request $request, $id)
   {
      if ($datos = Productos::find($id)) {
         $datos->producto = $request->producto;
         $datos->valor = $request->valor;

         if ($request->hasFile('foto')) {
            if ($datos->foto && file_exists(public_path('images/productos/' . $datos->logo))) {
               unlink(public_path('images/productos/' . $datos->foto));
            }

            $file = $request->file('foto');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/productos'), $fileName);
            $datos->foto = $fileName;
         }

         $datos->save();
         return response()->json(['success' => true, 'message' => 'Registro actualizado correctamente'], 200);
      } else {
         return response()->json(['success' => false, 'message' => 'No se encontro el registro'], 404);
      }
   }

   public function destroy($id)
   {
      try {
         $datos = Productos::find($id);
         $datos->delete();
         return response()->json(['success' => true, 'message' => 'Registro eliminado exitosamente'], 200);
      } catch (\Exception $e) {
         // Captura cualquier excepción y devuelve una respuesta de error
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function getAll()
   {
      $datos = Productos::all();
      return response()->json($datos);
   }
}
