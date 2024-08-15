<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
   public function index()
   {
      return view('empresa.index');
   }

   public function store(Request $request)
   {
      try {
         $datos = new Empresa();
         $datos->nit = $request->nit;
         $datos->razon_social = $request->razon_social;
         $datos->representante = $request->representante;
         $datos->direccion = $request->direccion;
         $datos->ciudad = $request->ciudad;
         $datos->telefono = $request->telefono;
         $datos->web = $request->web;
         $datos->correo = $request->correo;

         if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/empresa'), $fileName);
            $datos->logo = $fileName;
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
      $datos = Empresa::find($id);
      if ($datos) {
         return response()->json(['datos' => $datos], 200);
      } else {
         return response()->json(['datos' => null, 'message' => 'No se encontro el registro'], 404);
      }
   }

   public function update(Request $request, $id)
   {
      if ($datos = Empresa::find($id)) {
         $datos->nit = $request->nit;
         $datos->razon_social = $request->razon_social;
         $datos->representante = $request->representante;
         $datos->direccion = $request->direccion;
         $datos->ciudad = $request->ciudad;
         $datos->telefono = $request->telefono;
         $datos->web = $request->web;
         $datos->correo = $request->correo;

         if ($request->hasFile('logo')) {
            if ($datos->logo && file_exists(public_path('images/empresa/' . $datos->logo))) {
               unlink(public_path('images/empresa/' . $datos->logo));
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/empresa'), $fileName);
            $datos->logo = $fileName;
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
         $datos = Empresa::find($id);
         $datos->delete();
         return response()->json(['success' => true, 'message' => 'Registro eliminado exitosamente'], 200);
      } catch (\Exception $e) {
         // Captura cualquier excepción y devuelve una respuesta de error
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }

   public function getAll()
   {
      $datos = Empresa::all();
      return response()->json($datos);
   }
}
