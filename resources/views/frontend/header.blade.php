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
  <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/foundation.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/owlcarousel/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/owlcarousel/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/front_style.css') }}">

  <script src="{{ url('js/vendor/modernizr.js') }}"></script>
  
  <!-- Scripts -->
  <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
</head>
<body>
  @if($errors->has('correo'))
  <span class="error error-frontpage">{{ $errors->first('correo') }}</span>
  @endif
  @if(session()->has('msj'))
    <div data-alert class="alert-box alert-box-frontpage success">
      {{ session('msj') }}
      <a href="#" class="close">&times;</a>
    </div>
  @endif
  @if(session()->has('error_msj'))
    <div data-alert class="alert-box alert-box-frontpage alert">
      {{ session('error_msj') }}
      <a href="#" class="close">&times;</a>
    </div>
  @endif
  <div id="body-fronted">
    
  
  <nav class="top-bar" id="nav-frontend" data-topbar role="navigation" data-options="is_hover: false">
    <ul class="title-area">
      <li class="name content-title-next">
        <h1><a href="{{ route('next') }}" id="titulo-next">{{ config('app.name', 'Laravel') }}</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
      <ul class="right">
        <li class="dotted">
          <a href="{{ route('next') }}">Inicio</a>
        </li>
        <li class="dotted">
          <a href="{{ route('contacto-personal') }}">Contacto</a>
        </li>
        {{-- <li class="has-dropdown dotted">
          <a class="last-clicked">Contácto</a>
          <ul class="dropdown">
            <li><a href="{{ route('contacto-personal') }}">Personal</a></li>
            <li><a href="{{ route('contacto-corporativo') }}">Corporativo</a></li>
          </ul>
        </li> --}}
        <li class="has-dropdown dotted">
          <a class="last-clicked">Categorías</a>
          <ul class="dropdown">
            <li v-for="c in categorias"><a :href="'/categoria/'+c.slug">@{{ c.name }}</a></li>
          </ul>
        </li>
        <?php //$categorias = DB::table('categories')->select('id' ,'name')->get(); ?>
       {{--  <li v-for="c in categorias" class="dotted">
          <a :href="'/categoria/'+c.slug">@{{ c.name }}</a>
        </li> --}}
        <li class="dotted">
          <a href="{{ route('producto.carrito_de_compras') }}">
            <i class="fa fa-opencart fa-lg" aria-hidden="true"></i></i> Mi Bolsa
            @if( Session::has('cart') && Session::get('cart')['totalQty'] > 0)
              <span class="badge-shopping badge animated bounceIn">{{ Session::get('cart')->totalQty }}</span>
            @endif
          </a>
        </li>
      </ul>
    </section>
  </nav>
  
  @yield('content')

  <footer>
    <div class="large-12 columns footer-columnas">
      <div class="small-12 medium-3 large-3 columns">
        <h4>Acerca de Alpaca Tamon</h4>
        <ul class="no-bullet list-white">
          <li><a href="{{ route('quienes-somos') }}">Quiénes Somos</a></li>
          <li><a href="{{ route('mision') }}">Misión</a></li>
          <li><a href="{{ route('vision') }}">Visión</a></li>
        </ul>
      </div>
      <div class="small-12 medium-3 large-3 columns">
        <h4>Categorías</h4>
        <ul class="no-bullet list-white">
          <li v-for="c in categorias"><a :href="'/categoria/'+c.slug">@{{ c.name }}</a></li>
        </ul>
      </div>
      <div class="small-12 medium-3 large-3 columns">
        <h4>Atención al cliente</h4>
        <ul class="no-bullet">
          <li class="direccion"><i class="fa fa-map-marker" aria-hidden="true"></i> Calle Garcilaso 210</li>
          <li class="phone-number"><i class="fa fa-phone" aria-hidden="true"></i> 084-260805</li>
          <li class="horario"><i class="fa fa-clock-o" aria-hidden="true"></i> L-S: 10 - 20 hrs | D: 10 - 18 hrs</li>
        </ul>
      </div>
      <div class="small-12 medium-3 large-3 columns">
        <h4>Síguenos</h4>
        <ul class="inline-list redes-sociales">
          <li>
            <a href="#"><figure><img src="{{ url('images/facebook.svg') }}"></figure></a>
          </li>
          <li>
            <a href="#"><figure><img src="{{ url('images/twitter.svg') }}"></figure></a>
          </li>
          <li>
            <a href="#"><figure><img src="{{ url('images/youtube.svg') }}"></figure></a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('/js/vendor/jquery.js') }}"></script>
  <script src="{{ asset('/js/foundation.min.js') }}"></script>
  <script src="{{ asset('/js/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/js/funciones.js') }}"></script>
  <script src="{{ asset('/js/jquery.elevatezoom.js') }}"></script>
  <script src="{{ asset('/js/vue.js') }}"></script>
  <script src="{{ asset('/js/axios.min.js') }}"></script>
  <script src="{{ asset('/js/main.js') }}"></script>
  <script>
    $(document).foundation();
  </script>
</body>
</html>