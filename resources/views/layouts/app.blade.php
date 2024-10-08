<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

   <!-- Scripts -->
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   @yield('css')
</head>

<body>
   <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
         <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
               <img src="{{ asset('images/empresa/logo-header-es.svg') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="{{ __('Toggle navigation') }}">
               <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <!-- Left Side Of Navbar -->
               <ul class="navbar-nav me-auto">
                  @auth
                  <!-- Menú de Configuración con submenú -->
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Configuración
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/productos">Productos</a></li>
                        <li><a class="dropdown-item" href="/empresa">Empresa</a></li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="/clientes">Clientes</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="/mis-cotizaciones">Mis Cotizaciones</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="/nueva-cotizacion">Nueva Cotización</a>
                  </li>

                  @endauth
               </ul>

               <!-- Right Side Of Navbar -->
               <ul class="navbar-nav ms-auto">
                  <!-- Authentication Links -->
                  @guest

                  @else
                  <li class="nav-item dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                     </a>

                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                     </div>
                  </li>
                  @endguest
               </ul>
            </div>
         </div>
      </nav>

      <main class="py-4 container">

         @yield('content')
      </main>
   </div>
   <script>
      var forms = document.querySelectorAll('.needs-validation')
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
         .forEach(function (form) {
            form.addEventListener('submit', function (event) {
               if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
               }
               form.classList.add('was-validated')
            }, false)
         })
   </script>
   @yield('js')
</body>

</html>
