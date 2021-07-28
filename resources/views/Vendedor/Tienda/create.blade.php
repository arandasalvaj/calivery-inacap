@extends('Vendedor.layouts.layoutsV')

@section('contenido')
<div class="container">
    <div class="col-8 mx-auto">
        <h3 class="display-4 text-center">Bienvenido {{$user=Auth::user()->name}}</h3>
    <h5 class=" text-center my-4">Rellena el siguiente formulario para crear tu tienda.</h5>
    <form action="{{route('tienda.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre de tu tienda" name="nombre">
        </div>
        <div class="form-group">
          <label for="address_address">Direccion</label>
          <input type="text" class="form-control" placeholder="Dirección de la tienda" name="direccion">
          <input type="hidden" class="form-control"  id="longitude" name="longitude">
          <input type="hidden" class="form-control" id="latitude" name="latitude">
          <div id='map' style='width: 100%; height: 300px;'></div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Telefono</label>
            <input type="number" class="form-control"   placeholder="Telefono de tu tienda" name="telefono">
        </div>
        <fieldset disabled>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" placeholder="El e-mail de tu tienda" name="email" value="{{Auth::user()->email}}">
            </div>
        </fieldset>
        <div class="form-group">
            <label for="exampleInputEmail1" class="pr-1">Rubro</label>
            <a href="#" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                </svg>
            </a>
            <!------------------------INICIO MODAL---------------------------->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Lista de Rubros</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th >Rubro</th>
                                <th >Relaciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                              <tr>
                                <th>Miguel</th>
                                <td>Mark</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            <!-----------------------TERMINO MODAL------------------------------>
            <input type="text" class="form-control"placeholder="Rubro de tu tienda" name="rubro">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Logo</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" required name="img">
                <label class="custom-file-label" for="validatedCustomFile">Seleccione Logo...</label>
              </div>
        </div>
        <button type="submit" class="btn btn-success btn-lg btn-block">Crear Tienda</button>
    </form>
    </div>

</div>

@section('scripts')
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