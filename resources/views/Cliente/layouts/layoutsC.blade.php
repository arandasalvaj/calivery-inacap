<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <style>
      .carousel-inner img{
        width: 100%;
        height: 100%;
      }
      footer {
        background-color: black;
        
        bottom: 0;
        width: 100%;
        height: 40px;
        color: white;
      }
      
    </style>
    <nav class="navbar navbar fixed-top navbar-expand-lg navbar-dark shadow-sm" style="background-color: #ff9b22;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a href={{ url('/') }} class="navbar-brand ml-5" ><img src="https://i.ibb.co/cYXGQTG/logoC2.png" width="150px" height="50px" alt="logoC2" border="0"></a>
          
          
          <div class="col ">
            <h1></h1>
           </div>
          <div class="col-7 ">
              <input class="form-control mr-sm-2" type="search" placeholder="Buscar" id="search">
           </div>
           <div class="col mr-4">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
          </div>  
          <ul class="navbar-nav  ml-auto ">
            @if (Route::has('login'))
                @auth
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                  <li class="nav-item ">
                    <a class="nav-link text-white" href="{{route('cart.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                        <span class="badge badge-danger ">{{contadorCart()}}</span></a>
                  </li>
                  @hasrole('Delivery')
                  <div class="dropdown ml-3 mr-5">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-white">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{ route('dashboard.repartidor') }}"><span >Dashboard</span><span class="sr-only"></span></a>
                      <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>{{ __('Salir') }}</span></a>
                    </div>
                  </div>
                @endhasrole
                  @hasrole('Store')
                      <div class="dropdown ml-3 mr-5">
                        <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-white">{{Auth::user()->name}}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{ route('tienda.index') }}"><span >Dashboard</span><span class="sr-only"></span></a>
                          <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>{{ __('Salir') }}</span></a>
                        </div>
                      </div>
                  @endhasrole
                  @hasrole('Customer')
                    <div class="dropdown ml-3 mr-5">
                      <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="text-white">{{Auth::user()->name}}</span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('cliente.perfil') }}"><span >Mi Perfil</span><span class="sr-only"></span></a>
                        <a class="dropdown-item" href="{{ route('ordenesCliente') }}"><span >Mi Ordenes</span><span class="sr-only"></span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>{{ __('Salir') }}</span></a>
                      </div>
                    </div>
                  @endhasrole
                  @hasrole('Seller')
                    <div class="dropdown ml-3 mr-5">
                      <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="text-white">{{Auth::user()->name}}</span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('tienda.index') }}"><span >Dashboard</span><span class="sr-only"></span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>{{ __('Salir') }}</span></a>
                      </div>
                    </div>
                @endhasrole
                @else


                <li class="nav-item">
                  <a class="nav-link" href="{{ route('seguimiento') }}"><span  class="text-white">Seguimiento</span><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}"><span  class="text-white">Iniciar Sesion</span><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}"><span  class="text-white">Registrar</span><span class="sr-only">(current)</span></a>
                </li>  
                @endauth
            @endif  
           </ul>
        </div>
        </div>
      </nav>
    <title>@yield('titulo')</title>
  </head>

  <body style="background-color: hsl(0, 0%, 100%)">
@yield('contenido')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>


  <script>
  $(document).ready(function(){
    if($('.bbb_viewed_slider').length){
      var viewedSlider = $('.bbb_viewed_slider');

      viewedSlider.owlCarousel({
          loop:true,
          margin:30,
          autoplay:true,
          autoplayTimeout:6000,
          nav:false,
          dots:false,
          responsive:
        {
          0:{items:1},
          575:{items:2},
          768:{items:3},
          991:{items:4},
          1199:{items:6}
        }
      });

      if($('.bbb_viewed_prev').length){
        var prev = $('.bbb_viewed_prev');
        prev.on('click', function(){
          viewedSlider.trigger('prev.owl.carousel');
        });
      }

      if($('.bbb_viewed_next').length){
        var next = $('.bbb_viewed_next');
        next.on('click', function(){
          viewedSlider.trigger('next.owl.carousel');
        });
      }
    }
  });
  </script>
    @yield('scripts')
  </body>
  <footer class="container-fluid text-center text-white align-item-center" style="height:70px; background-color: #ff9b22;">
      <p>Calivery 2021</p>
  </footer>
</html>