@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center mt-5">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header text-center">
               <h3>Iniciar sesión</h3>
            </div>

            <div class="card-body">
               <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="row mb-3">
                     <label for="email" class="col-md-4 col-form-label text-md-end">Correo eletrónico</label>

                     <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-3">
                     <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                     <div class="col-md-6">
                        <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-md-6 offset-md-4 d-flex">
                        <div class="form-check justify-content-around">
                           <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                              old('remember') ? 'checked' : '' }}>

                           <label class="form-check-label" for="remember">
                              Recordar sesión?
                           </label>
                        </div>

                     </div>
                  </div>
                  <div class="row mb-0">
                     <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary w-75">
                           Iniciar sesión
                        </button>
                        @if (Route::has('password.request'))
                        <a class=" btn btn-link" href="{{ route('password.request') }}">
                           Olvido su contraseña?
                        </a>
                        @endif
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection