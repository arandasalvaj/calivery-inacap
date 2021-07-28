@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-4">
<div class="container-fluid pt-5">
    <div class="row my-5 mx-5 px-2">
        <div class="col-sm-12 col-lg-7">
            <div class="col ">
                <div class="card shadow p-3 mb-5 bg-white " style="border-radius: 15px;">
                    <div class="card-body px-5">
                        <div class="div text-center">
                            <form action="{{route('item.store')}}" method="POST">
                            <h3>Información de contacto</h3>
                        </div>
                        <fieldset disabled>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{cart()->user->name}} {{cart()->user->lastname}}">
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Telefono</label>
                            <input type="number" class="form-control" name="cellphone"" 
                            @if(cart()->user->cellphone=='')
                            placeholder="Ingrese Telefono de contacto"
                            @endif value="{{cart()->user->cellphone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Rut</label>
                            <input type="text" class="form-control" name="rut"
                            @if(cart()->user->rut=='')
                            placeholder="Ingrese su rut"
                            @endif value="{{cart()->user->rut}}">
                        </div>
                    </div>
                </div>
            </div>
            @if (direccion()->address==null)
                <div class="col mt-2 mb-5">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <input name="collapseGroup" type="radio" data-toggle="collapse" aria-expanded="true" data-target="#collapseOne" checked/>
                        <label class="form-check-label" for="exampleRadios2">
                            <h4>Nueva Direccion</h3>
                        </label> 
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div id="collapseOne" class="panel-collapse collapse" aria-expanded="true">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Dirección de la tienda" name="direccion">
                                        <input type="hidden" class="form-control"  id="longitude" name="longitude">
                                        <input type="hidden" class="form-control" id="latitude" name="latitude">
                                        <div id='map' style='width: 100%; height: 200px;'></div>
                                      </div>
                                </div>
                                </div>
                            </div>
                            </div> 
                        </div>
                    </div>
                </div>
            @endif
            @if (!direccion()->address==null)
            <div class="col-sm-12 col-md-12">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                    <input name="collapseGroup" type="radio" data-toggle="collapse" data-target="#collapseOne" checked/>
                    <label class="form-check-label" for="exampleRadios2">
                        <h4>{{direccion()->address->name}}</h3>
                    </label>  
                    </div>
                </div>  
            </div>
            <div class="col-sm-12 col-md-12 mt-2 mb-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <input name="collapseGroup" type="radio" data-toggle="collapse" data-target="#collapseOne" />
                    <label class="form-check-label" for="exampleRadios2">
                        <h4>Nueva Dirección</h3>
                    </label> 
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Dirección de la tienda" name="direccion" value="{{direccion()->address->name}}">
                                    <input type="hidden" class="form-control"  id="longitude" name="longitude">
                                    <input type="hidden" class="form-control" id="latitude" name="latitude">
                                    <input type="hidden" class="form-control"  id="longitude1"  value="{{direccion()->address->address_latitude}}">
                                    <input type="hidden" class="form-control" id="latitude1" value="{{direccion()->address->address_longitude}}">
                                    <div id='map' style='width: 100%; height: 200px;'></div>
                                  </div>
                            </div>
                            </div>
                        </div>
                        </div> 
                    </div>
                </div>
            </div>
            @endif
        </div>

    <div class="col-md-12 col-lg-5">
        <div class="card shadow p-3 mb-5 bg-white " style="border-radius: 15px;">
            <div class="card-body px-5">
               <div class="row px-3"> <h3>Detalles del pedido</h3></div>
               <hr class="my-auto flex-grow-1">
                @foreach (productosCart() as $Cart)
                <div class="card border-light">
                    <div class="card-body px-5">
                        <div class="row mt-3">
                            <div class="col-3">
                                <img src="{{asset($Cart->productos->img)}}" alt="" class=" img-fluid">
                            </div>
                            <div class="col-6">
                                <div class="col ">
                                    <h5>{{$Cart->productos->name}}</h5>
                                    Cant: {{$Cart->quantity}}
                                    <h5>${{number_format($Cart->productos->price,0)}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-auto flex-grow-1 ">
                @endforeach
                <div class="container">
                    <hr class="my-auto flex-grow-1 ">
                </div>
                <div class="row mt-2">
                    <div class="col-8">
                        <h5>Subtotal:</h5>
                    </div>
                    <div class="col-4">
                        <h5>${{number_format($Cart->carros->total,0)}}</h5>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-8">
                        <h5>Envío:</h5>
                    </div>
                    <div class="col-4">
                        <h5>${{number_format(precioEnvioTotal(),0)}}</h5>
                    </div>
                </div>
                <hr class="my-auto flex-grow-1 pt-3">
                <div class="row">
                    <div class="col-8">
                        <h4>Total:</h4>
                    </div>
                    <div class="col-4">
                        <h5>${{number_format($Cart->carros->total+precioEnvioTotal(),0)}}</h5>
                    </div>
                </div>
                
                    @csrf
                    <div class="col">
                        <div class="col-12 px-4 mt-3">
                            <button class="btn btn-primary btn-lg btn-block">Continuar con la compra</button>   
                        </div>
                    </div>
                    <input type="hidden" name="idOrden" value="{{$order->id}}">
                </form>
            </div>
          </div>
    </div>
    </div>
</div>
</section>
@section('scripts')
<script>
  const defaultLocation=[-68.92337805102204,-22.452896494079937];
  
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