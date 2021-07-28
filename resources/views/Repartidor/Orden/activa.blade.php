@extends('Repartidor.layouts.layoutsR')

@section('contenido')
<style>
  #marker1 {
  background-image: url('https://i.ibb.co/FndJ9fT/Icono-User.jpg');
  background-size: cover;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  }
   
  .mapboxgl-popup {
  max-width: 200px;
  }

  #marker {
  background-image: url('https://i.ibb.co/0BqNFRL/Icono-Store.jpg');
  background-size: cover;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  }
   
  .mapboxgl-popup {
  max-width: 200px;
  }
  </style>
<section>
  <div class="container">
  @if(envioActivoActual())









    @if(estadoShippingVendedor())
      <div class="card">
        <div class="card-header">
          Orden N-000{{envioActivoVendedor()->id}}
        </div>
        <div class="card-body">
          <p class="card-text">
            <div class="row">
            <div class="col-sm-12 col-lg-6">
            <!---Comienza tabla de productos-->
            <div class="row">
              <div class="col-4">
                Cantidad
              </div>
              <div class="col-4">
                Descripcion
              </div>
              <div class="col-4">
                Precio
              </div>
            </div>
            @foreach (buscarItem(envioActivoVendedor()->ordenStore->order_id,envioActivoVendedor()->ordenStore->store_id) as $item)
                <hr>
                <div class="row">
                  <div class="col-4">
                    <span class="ml-4" >{{$item->quantity}}</span>
                  </div>
                  <div class="col-4">
                    <span>{{$item->name}}</span>
                  </div>
                  <div class="col-4">
                    <span>${{number_format($item->price,0)}}</span>
                  </div>
                </div>
            @endforeach

            <!--Termina Acordeon--->
          </div>
          <hr>
          <div class="col-sm-12 col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-center">{{buscarDireccionTienda(envioActivoVendedor()->ordenStore->store_id)->address->name}}</h5>
                </div>
                  <!----INICIO-DESTINO--->
                  <input  type="hidden" id="inicio2" name="address_address" class="form-control map-input" value="{{buscarDireccionTienda(envioActivoVendedor()->ordenStore->store_id)->address->address_longitude}}">
                  <input type="hidden" id="inicio3" name="address_address" class="form-control map-input" value="{{buscarDireccionTienda(envioActivoVendedor()->ordenStore->store_id)->address->address_latitude}}">
                  <!----FIN-DESTINO--->
                  
                  <!----INICIO-SUNDO DESTINO--->
                  <input  type="hidden" id="destino2" name="address_address" class="form-control map-input" value="-68.92840965925524">
                  <input  type="hidden" id="destino3" name="address_address" class="form-control map-input" value="-22.448113538541662">
                  <!----FIN-SUNDO DESTINO--->
                  <div id='map' style='width: 100%; height: 300px;'></div>
                </div>
              </div>

        </div>
          </p>
          <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Retirar</button>
          <!-----MODAL------->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmar Retiro</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Desea confirmar el retiro de los productos desde el vendedor?
                </div>
                <div class="modal-footer">
                  <form action="{{route('repartidor.orden.estado')}}" method="POST">
                    @csrf
                    <input  type="hidden" name="id" class="form-control map-input" value="{{envioActivoVendedor()->id}}">
                    <input  type="hidden" name="status" class="form-control map-input" value="2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-----MODAL------->
        </div>
      </div>
    @endif





    @if(estadoShippingCliente())
    <div class="card">
      <div class="card-header">
        Orden N-000{{envioActivoCliente()->id}}
      </div>
      <div class="card-body">
       
        <p class="card-text">
          <div class="row">
          <div class="col-sm-12 col-lg-6">
          <!---Comienza tabla de productos-->
          <div class="row">
            <div class="col-4">
              Cantidad
            </div>
            <div class="col-4">
              Descripcion
            </div>
            <div class="col-4">
              Precio
            </div>
          </div>
          @foreach (buscarItem(envioActivoCliente()->ordenStore->order_id,envioActivoCliente()->ordenStore->store_id) as $item)
              <hr>
              <div class="row">
                <div class="col-4">
                  <span class="ml-4" >{{$item->quantity}}</span>
                </div>
                <div class="col-4">
                  <span>{{$item->name}}</span>
                </div>
                <div class="col-4">
                  <span>${{number_format($item->price,0)}}</span>
                </div>
              </div>
          @endforeach

          <!--Termina Acordeon--->
        </div>
        <hr>
        <div class="col-sm-12 col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">{{envioActivoCliente()->user->address->name}}</h5>
              </div>
                <!----INICIO-DESTINO--->
                <input  type="hidden" id="inicio2" name="address_address" class="form-control map-input" value="{{envioActivoCliente()->user->address->address_longitude}}">
                <input type="hidden" id="inicio3" name="address_address" class="form-control map-input" value="{{envioActivoCliente()->user->address->address_latitude}}">
                <!----FIN-DESTINO--->
                
                <!----INICIO-SUNDO DESTINO--->
                <input  type="hidden" id="destino2" name="address_address" class="form-control map-input" value="-68.92840965925524">
                <input  type="hidden" id="destino3" name="address_address" class="form-control map-input" value="-22.448113538541662">
                <!----FIN-SUNDO DESTINO--->
                <div id='map' style='width: 100%; height: 300px;'></div>
              </div>
            </div>

      </div>
        </p>
        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#example">Entrega</button>
        <!-----MODAL------->
        <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="example">Confirmar Entrega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿Desea confirmar la entrega de los productos al cliente?
              </div>
              <div class="modal-footer">
                <form action="{{route('repartidor.orden.estado')}}" method="POST">
                  @csrf
                  <input  type="hidden" name="id" class="form-control map-input" value="{{envioActivoCliente()->id}}">
                  <input  type="hidden" name="status" class="form-control map-input" value="3">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Confirmar</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-----MODAL------->
      </div>
    </div>
    @endif








    @else







      <h5 class="display-4 text-center">No hay orden activa.</h5>





  @endif
</div>
</section>
@section('scripts')
<script>

  const defaultLocation=[-68.92486784776037,-22.45808599192175];

  mapboxgl.accessToken = '{{env("MAPBOX_KEY")}}';

  var map = new mapboxgl.Map({
    container: 'map',
    center: defaultLocation,
    zoom: 12,
    style: 'mapbox://styles/mapbox/streets-v11'

  });
  var geolocate = new mapboxgl.GeolocateControl();

    map.addControl(geolocate);

    geolocate.on('geolocate', function(e) {
        var lon = e.coords.longitude;
        var lat = e.coords.latitude
        var position = [lon, lat];
        console.log(position);
    });

    var canvas = map.getCanvasContainer();

    var start = [document.getElementById("inicio2").value,document.getElementById("inicio3").value];

function getRoute() {
  var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' +document.getElementById("inicio2").value+','+document.getElementById("inicio3").value+';'+document.getElementById("destino2").value+','+document.getElementById("destino3").value+'?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;

  var req = new XMLHttpRequest();
  req.open('GET', url, true);
  req.onload = function() {
    var json = JSON.parse(req.response);
    var data = json.routes[0];
    var route = data.geometry.coordinates;
    var geojson = {
      type: 'Feature',
      properties: {},
      geometry: {
        type: 'LineString',
        coordinates: route
      }
    };
    if (map.getSource('route')) {
      map.getSource('route').setData(geojson);
    } else {
      map.addLayer({
        id: 'route',
        type: 'line',
        source: {
          type: 'geojson',
          data: {
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'LineString',
              coordinates: geojson
            }
          }
        },
        layout: {
          'line-join': 'round',
          'line-cap': 'round'
        },
        paint: {
          'line-color': '#3887be',
          'line-width': 5,
          'line-opacity': 0.75
        }
      });
    }
  };
  req.send();
}

map.on('load', function() {
  getRoute(start);
  map.addLayer({
    id: 'point',
    type: 'circle',
    source: {
      type: 'geojson',
      data: {
        type: 'FeatureCollection',
        features: [{
          type: 'Feature',
          properties: {},
          geometry: {
            type: 'Point',
            coordinates: start
          }
        }
        ]
      }
    },
    paint: {
      'circle-radius': 10.5,
      'circle-color': '#3887be'
    }
  });

  var endd = [document.getElementById("destino2").value,document.getElementById("destino3").value];
    map.addLayer({
      id: 'end',
      type: 'circle',
      source: {
        type: 'geojson',
        data: {
          type: 'FeatureCollection',
          features: [{
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'Point',
              coordinates: endd
            }
          }]
        }
      },
      paint: {
        'circle-radius': 10.5,
        'circle-color': '#3887be'
      }
    });
    getRoute(endd);

    var popup = new mapboxgl.Popup({ offset: 25 }).setText(
        'Construction on the Washington Monument began in 1848.'
    );
 
    // create DOM element for the marker
    var el = document.createElement('div');
    el.id = 'marker';
 
    // create the marker
    new mapboxgl.Marker(el)
        .setLngLat(endd)
        .setPopup(popup) // sets a popup on this marker
        .addTo(map);



        var popup = new mapboxgl.Popup({ offset: 25 }).setText(
        'Construction on the Washington Monument began in 1848.'
    );
 
    // create DOM element for the marker
    var el = document.createElement('div');
    el.id = 'marker1';
 
    // create the marker
    new mapboxgl.Marker(el)
        .setLngLat(start)
        .setPopup(popup) // sets a popup on this marker
        .addTo(map);
    });


</script>
@stop
@endsection