<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- If you delete this meta tag World War Z will become a reality -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
  <link rel="stylesheet" href="{{ url('/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ url('/css/foundation.css') }}">
  <link rel="stylesheet" href="{{ url('/css/style.css') }}">

  <script src="{{ url('js/vendor/modernizr.js') }}"></script>
  
  <!-- Scripts -->
  <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
</head>
<body>
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="{{ url('/home') }}">Dashboard</a></h1>
      </li>
       <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
        <li class="has-dropdown">
          <a href="#">Productos</a>
          <ul class="dropdown">
            <li class="active"><a href="{{ url('productos') }}">Lista de productos</a></li>
            <li class="active"><a href="{{ url('productos/create')}}">Agregar producto</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">Ofertas</a>
          <ul class="dropdown">
            <li class="active"><a href="{{ url('ofertas') }}">Lista de ofertas</a></li>
            <li class="active"><a href="{{ url('ofertas/create')}}">Agregar oferta</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">Categorias</a>
          <ul class="dropdown">
            <li class="active"><a href="{{ url('categorias') }}">Lista de categorias</a></li>
            <li class="active"><a href="{{ url('categorias/create')}}">Agregar categoria</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">{{ Auth::user()->name }}</a>
          <ul class="dropdown">
            <li class="active">
              <a href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      </ul>

      <!-- Left Nav Section -->
      <ul class="left">
        <li><a href="{{ url('/') }}" target="_blank">Ir a la tienda</a></li>
      </ul>
    </section>
  </nav>

  @yield('content')

  <!-- Scripts -->
  <script src="{{ asset('/js/vendor/jquery.js') }}"></script>
  <script src="{{ asset('/js/foundation.min.js') }}"></script>
  <!-- <script src="{{ asset('js/funciones.js') }}"></script> -->
  <script src="{{ asset('/js/jquery.multi-select.js') }}"></script>
  <script src="{{ asset('/js/funciones_admin.js') }}"></script>

  <script>
    $(document).foundation();
  </script>
</body>
</html>