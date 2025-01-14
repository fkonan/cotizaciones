<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cotizaciones;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   use RegistersUsers;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = '/home';

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth');
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Models\User
    */
   protected function storeUser(array $data)
   {
      return User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password']),
      ]);
   }

   public function create(Request $request)
   {
      $data = $request->validate([
         'documento' => 'required|string|max:20',
         'name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:users',
         'password' => 'required|string|min:8|confirmed',
      ]);

      $datos = User::where('documento', $request->documento)->first();
      if ($datos) {
         return redirect()->back()->withErrors([
            'documento' => 'El número de documento ya se encuentra registrado',
         ])->withInput();
      }
      $user = new User();
      $user->documento = $request->documento;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->is_admin = 0;
      $user->save();

      return redirect()->back()->with('success', 'Usuario registrado con éxito.');
   }

   public function showRegistrationForm()
   {
      return view('auth.register');
   }

   public function index()
   {
      return view('auth.index');
   }

   public function getAll()
   {
      $datos = User::get();
      return response()->json($datos);
   }

   public function destroy($id)
   {
      try {
         $datos = User::find($id);
         if (Cotizaciones::where('user_id', $datos->id)->count() > 0) {
            return response()->json(['success' => false, 'message' => 'No se puede eliminar el usuario porque tiene cotizaciones asociadas'], 200);
         }
         $datos->delete();
         return response()->json(['success' => true, 'message' => 'Registro eliminado exitosamente'], 200);
      } catch (\Exception $e) {
         // Captura cualquier excepción y devuelve una respuesta de error
         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
      }
   }
}
