<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NEXT</title>

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">

    <!-- <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/slider.js"></script> -->
    <!-- Styles -->
    <style>
      html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
      }

      .full-height {
        height: 100vh;
      }

      .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
      }

      .position-ref {
        position: relative;
      }

      .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
      }

      .content {
        text-align: center;
        color: #fff;
      }

      .title {
        color: #72C63B;
        text-shadow: 1px 2px 3px #000;
        font-size: 84px;
        font-weight: 500;
      }

      .links > a {
        color: inherit;
        padding: 0 25px;
        font-size: 1.5em;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        text-shadow: 1px 2px 3px #000;
      }

      .links > a:hover {
        color: #72C63B;
      }

      .m-b-md {
        margin-bottom: 30px;
      }

      .fondo {
        background-image: url(images/machupicchu_wallpaper.jpg);
      }

      .shadow {
        background-color: rgba(0,0,0,.4);
        position: absolute;
        width: 100%;
        height: 100vh;
        z-index: 1;
        top: 0;
        left: 0;
      }

      .content, .top-right {
        position: relative;
        z-index: 5;
      }

      .slogan {
        margin-top: 30px;
      }

      .slogan > span {
        text-shadow: 1px 2px 3px #000;
      }
    </style>
  </head>
    <body>
      <div class="fondo flex-center position-ref full-height">
        <div class="shadow"></div>
        <!-- @if (Route::has('login'))
          <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
          </div>
        @endif -->
        <div class="content">
          <div class="title m-b-md">
            NEXT
          </div>

          <div class="links">
            <a href="#">Lima</a>
            <a href="#">Arequipa</a>
            <a href="cusco">Cusco</a>
            <a href="#">Trujillo</a>
            <a href="#">Puno</a>
          </div>

          <div class="slogan">
            <span>"Somos una empresa con años de experiencia ofreciendo a nuestros clientes lo mejor de lo mejor."</span>
          </div>
        </div>
      </div>
    </body>
</html>
