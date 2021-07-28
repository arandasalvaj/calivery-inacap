@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-5">
    <div class="container mt-5">
        <h3 class=" display-4 text-center pt-5">Mi Perfil</h3>
      <div class="card m-5" style="border: none; background-color: rgba(255, 0, 0, 0);">
        <div class="card-body ">
          <div class="row">
            <div class="col-5">
              <section>
                <div class="col-sm-12 col-lg-6 pb-5">
                  <div class="card" style="width: 24rem;">
                    <img class="card-img-top img-fluid" style="width: 400px;" src="https://i.ibb.co/cwZhf3X/profile1.png" >
                    <div class="card-body">
                      <div class="col">
                        <div class="row">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                          <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                          </svg>
                          <h4 class="pl-3">{{Auth::user()->name}} {{Auth::user()->lastname}}</h4>
                        </div>
                      </div>
                      <div class="col">
                        <div class="row">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                          </svg>
                          <h4 class="pl-3">{{Auth::user()->email}}</h4>
                        </div>
                      </div>
                      <div class="col">
                        <div class="row">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                          <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                          </svg>
                          <h4 class="pl-3">{{Auth::user()->cellphone}}</h4>
                      </div>
                    </div>
                      
                      <div class="col">
                        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                          Eliminar Cuenta
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Cuenta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                ¿Desea eliminar su cuenta?
                                Todos sus datos seran eliminados.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  <form action="{{ route('usuario.destroy',Auth::user()->id) }}" method="POST">
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
              </section>
      
            </div>
            <div class="col-sm-12 col-lg-6 ml-4 pb-5">
                <form enctype="multipart/form-data" action="{{route('cliente.perfil.update',Auth::user()->id)}}" method="POST">
                  @csrf

                  <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control" placeholder="Tu nombre" name="name" value="{{Auth::user()->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" class="form-control" placeholder="Tu apellido" name="lastname" value="{{Auth::user()->lastname}}">
                </div>
                  <fieldset disabled>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                  </fieldset>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefono</label>
                        <input type="number" class="form-control" placeholder="Tu numero de telefono" name="cellphone" value="{{Auth::user()->cellphone}}">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Logo</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="validatedCustomFile" required name="img">
                      <label class="custom-file-label" for="validatedCustomFile">Cambiar logo</label>
                    </div>
                  </div>

                  @if(Auth::user()->address==null)
                      <div class="form-group">
                        <label for="address_address">Direccion</label>
                        <input type="text" class="form-control" placeholder="Tu direccion" name="address" value="">
                        <input type="hidden" class="form-control"  id="longitude" name="longitude">
                        <input type="hidden" class="form-control" id="latitude" name="latitude">
                        <input type="hidden" class="form-control"  id="longitude1"  value="">
                        <input type="hidden" class="form-control" id="latitude1" value="">
                        <div id='map' style='width: 100%; height: 300px;'></div>
                      </div>
                    
                    @else
                      <div class="form-group">
                        <label for="address_address">Direccion</label>
                        <input type="text" class="form-control" placeholder="Tu direccion" name="address" value="{{Auth::user()->address->name}}">
                        <input type="hidden" class="form-control"  id="longitude" name="longitude">
                        <input type="hidden" class="form-control" id="latitude" name="latitude">
                        <input type="hidden" class="form-control"  id="longitude1"  value="{{Auth::user()->address->address_latitude}}">
                        <input type="hidden" class="form-control" id="latitude1" value="{{Auth::user()->address->address_longitude}}">
                        <div id='map' style='width: 100%; height: 300px;'></div>
                      </div>    
                    @endif

                  <div class="row">
                    <div class="col">
                      <button type="submit" class="btn btn-warning btn-lg btn-block">Actualizar</button>
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>
    </div>
      <!--INICIO PERFIL-->   
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