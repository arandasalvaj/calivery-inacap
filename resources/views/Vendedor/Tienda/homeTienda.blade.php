@extends('Vendedor.layouts.layoutsV')

@section('contenido')

@if (session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alerta1">
        <strong>{{session()->get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<section >
<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Perfil</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="card m-5" style="border: none; background-color: rgba(255, 0, 0, 0);">
  <div class="card-body ">
    <div class="row">
      <div class="col-5">
        <section>
          <div class="col-sm-12 col-md-12 col-lg-6 px-5">
            <div class="card" style="width: 24rem;">
              <img class="card-img-top img-fluid" style="width: 400px;" src="{{asset($store->logo)}}" alt="Card image cap">
              <div class="card-body">
                <div class="col">
                  <div class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                    </svg>
                    <h4 class="pl-3">{{$store->name}}</h4>
                  </div>
                </div>
                <div class="col">
                  <div class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                    </svg>
                    <h4 class="pl-3">{{$store->email}}</h4>
                  </div>
                </div>
                <div class="col">
                  <div class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                    <h4 class="pl-3">{{$store->cellphone}}</h4>
                </div>
                  </div>
                <div class="col">
                  <div class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <h4 class="pl-3">{{$store->rubro}}</h4>
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#example">
                      Desactivar Tienda
                    </button>
                    <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="example">Desactivar tienda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ¿Desea desactivar la tienda Temporalmente?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <form action="{{ route('tienda.destroy',$store->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <button type="button" class="btn btn-danger px-5" data-toggle="modal" data-target="#exampleModal">
                    Eliminar
                  </button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar tienda</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          ¿Desea eliminar la tienda?
                          Todos sus datos relacionados a la tienda seran eliminados.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <form action="{{ route('tienda.destroy',$store->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Confirmar</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </section>

      </div>
      <div class="col-sm-12 col-lg-6 ">
        <div class="row  ">
          <h1 class="display-4 mx-auto my-5">Estadistica</h1>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Fecha de creacion:</label>
          <h4 class="ml-5">{{buscarTiendas(Auth::user()->id)->created_at}}</h4>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Cantidad de productos</label>
          <h4 class="ml-5">{{cantidadProductos()}}</h4>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Total de ventas:</label>
          <h4 class="ml-5">{{totalOrdenesPanel()}}</h4>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Fecha de creacion:</label>
          <h4 class="ml-5">{{buscarTiendas(Auth::user()->id)->created_at}}</h4>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Cantidad de productos</label>
          <h4 class="ml-5">{{cantidadProductos()}}</h4>
        </div>
        <div class="row  ml-5">
          <label for="exampleInputEmail1">Total de ventas:</label>
          <h4 class="ml-5">{{totalOrdenesPanel()}}</h4>
        </div>
      </div>
    </div>
  </div>
</div>
    <!--INICIO PERFIL-->
    
      
    </div>
    <!--FIN PERFIL-->

    <!--INICIO EDITAR-->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="container">
        <div class="col-8 mx-auto">
        <h3 class=" display-4 text-center">Datos</h3>
        
            <form enctype="multipart/form-data" action="{{route('tienda.update',$store->id)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre del producto" name="nombre" value="{{$store->name}}">
              </div>
              <fieldset disabled>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" value="{{$store->email}}">
                </div>
              </fieldset>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefono</label>
                    <input type="number" class="form-control" placeholder="Telefono de la tienda" name="cellphone" value="{{$store->cellphone}}">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Rubro</label>
                    <input type="text" class="form-control" placeholder="Rubro de la tienda" name="cellphone" value="{{$store->rubro}}">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Logo</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="validatedCustomFile" required name="img">
                  <label class="custom-file-label" for="validatedCustomFile">Cambiar logo</label>
                </div>
              </div>
              <div class="form-group">
                <label for="address_address">Direccion</label>
                <input type="text" class="form-control" placeholder="Dirección de la tienda" name="address" value="{{$store->address->name}}">
                <input type="hidden" class="form-control"  id="longitude" name="longitude">
                <input type="hidden" class="form-control" id="latitude" name="latitude">
                <input type="hidden" class="form-control"  id="longitude1"  value="{{$store->address->address_latitude}}">
                <input type="hidden" class="form-control" id="latitude1" value="{{$store->address->address_longitude}}">
                <div id='map' style='width: 100%; height: 300px;'></div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="submit" class="btn btn-warning btn-lg btn-block">Actualizar</button>
              </div>
            </form>
        </div>
      </div>
    </div>

    <!--FIN EDITAR-->
</section>

@section('scripts')
<script>
  const defaultLocation=[document.getElementById("latitude1").value,document.getElementById("longitude1").value];

  mapboxgl.accessToken = '{{env("MAPBOX_KEY")}}';

  var map = new mapboxgl.Map({
    container: 'map',
    center: defaultLocation,
    zoom: 15,
    style: 'mapbox://styles/mapbox/streets-v11'

  });
  var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl,
  });

  map.addControl(new mapboxgl.NavigationControl());

  var marker = new mapboxgl.Marker({
    draggable: true
  })
  .setLngLat(defaultLocation)
  .addTo(map);
 
  function onDragEnd() {
    var lngLat = marker.getLngLat();
    document.getElementById("latitude").value = lngLat.lat;
    document.getElementById("longitude").value = lngLat.lng;
  }
 
  marker.on('dragend', onDragEnd);

</script>
@stop
@endsection