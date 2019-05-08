<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ url('/css/foundation.css') }}">

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
          <h1><a href="{{ url('/') }}">NEXT</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class=""><a href="{{ url('/login') }}">Login</a></li>
          <li class=""><a href="{{ url('/register') }}">Register</a></li>
        </ul>
      </section>
    </nav>
    <div id="app" style="margin-top: 2rem;">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ url('js/vendor/jquery.js') }}"></script>
    <script src="{{ url('js/foundation.min.js') }}"></script>
    <script>
    $(document).foundation();
    </script>
    <!-- Scripts -->
</body>
</html>
