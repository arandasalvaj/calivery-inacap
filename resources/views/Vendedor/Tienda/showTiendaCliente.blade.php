@extends('Cliente.layouts.layoutsC')

@section('contenido')
<div class="container">
  
    <section class="pt-5">
        <div class="container pt-5">
          <div class="row text-center">
            <div class="col-12">
              <h3 class="display-3">{{$store->name}}</h3>
            </div>
          </div> 
        </div> 
      </section>
      <section>
        <div class="container">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="productos-tab" data-toggle="tab" href="#productos" role="tab" aria-controls="productos" aria-selected="true">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Datos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="productos-tab">
              <div class="row">
                @foreach (productosTienda($store->id) as $productos)
                      <div class="col-3 mx-3 py-4">
                        <div class="card" style="width: 18rem;">
                          <img src="{{asset($productos->img)}}"class="img-fluid img-thumbnail mx-auto d-block" style="height: 180px; width: 60%; border: none;" >
                            <div class="card-body">
                              <h5 class="card-title"><div class="bbb_viewed_name text-center"><a href="">{{($productos->name)}}</a></div></h5>
                              <p class="card-text text-danger text-center"><strong >${{number_format($productos->price,0)}}</strong></p>
                              <div class="row">
                                <div class="col">
                                  <form action="{{ route('cart.store')}}" method="post">
                                  <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                  </svg> Agregar</button>
                                </div>
                                <div class="col ">
                                  @csrf 
                                  <input type="hidden" name="product_id" value="{{$productos->id}}">
                                    <div class="py-1">
                                        <input placeholder="Enter a number" required type="number" name="quantity" min="1" max="{{($productos->stock)}}" value="1">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div> 
                    @endforeach
              </div>
            </div>

            <div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
              <section>
                  <div class="form-group">
                    <label for="address_address">Direccion</label>
                    <input type="text" class="form-control" placeholder="Dirección de la tienda" name="address" value="{{$store->address->name}}">
                    <input type="hidden" class="form-control"  id="longitude" name="longitude">
                    <input type="hidden" class="form-control" id="latitude" name="latitude">
                    <input type="hidden" class="form-control"  id="longitude1"  value="{{$store->address->address_latitude}}">
                    <input type="hidden" class="form-control" id="latitude1" value="{{$store->address->address_longitude}}">
                    <div id='map' style='width: 100%; height: 100px;'></div>
                  </div>
                </section>

              <section>
                <div class="container b">
                  <div class="row">
                    <div class="col-6">
                        <div class="card border">
                            <div class="card-body p-5">
                                <h1>Datos<h1>
                                    <hr>
                                  <h3>Ubicación</h3>
                                  <p>{{$store->address}}</p>
                                <h3>Telefono</h3>
                                <p>+569{{$store->cellphone}}</p>
                                <h3>Email</h3>
                                <p>{{$store->email}}</p>
                                <h3>Rubro</h3>
                                <p>{{$store->rubro}}</p>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </section>

            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            </div>
          </div>
        </div>
      </section>
</div>

<script>
  const defaultLocation=[-68.92337805102204,-22.452896494079937];

  mapboxgl.accessToken = '{{env("MAPBOX_KEY")}}';

  var map = new mapboxgl.Map({
    container: 'map',
    center: defaultLocation,
    zoom: 12,
    style: 'mapbox://styles/mapbox/streets-v11'

  });
  var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl,
  });

</script>

@endsection