<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Koffa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('intro/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('intro/css/responsive.css') }}">
    
    <!-- Js -->
    <script src="{{ asset('intro/js/vendor/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('intro/js/vendor/jquery-1.10.2.min.js') }}"><\/script>')</script>
    <script src="{{ asset('intro/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('intro/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('intro/js/plugins.js') }}"></script>
    <script src="{{ asset('intro/js/min/waypoints.min.js') }}"></script>
    <script src="{{ asset('intro/js/jquery.counterup.js') }}"></script>

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5N2JGcG6Xty2TWmAjyaz_0ILtq7F1vKo" type="text/javascript"></script>
    <script src="{{ asset('intro/js/google-map-init.js') }}"></script>


    <script src="{{ asset('intro/js/main.js') }}"></script>

    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">

  </head>
  <body>



    <!-- Header Start -->
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- header Nav Start -->
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Koffa">
                </a>
              </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
          </div>
        </div>
      </div>
    </header><!-- header close -->
        
    @yield('content')
    
    <!-- footer Start -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p>Copyright &copy; Design & Developed by <a href="https://www.facebook.com/Med.Slimani93">Mohamed SLimani</a>. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>          
    
    </body>
</html>