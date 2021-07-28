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
        @if(ordenesDisponibleReparto())
            @foreach (ordenesRepartir() as $item)
            <form action="{{route('repartidor.orden.reparto',$item->id)}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                NUMERO DE PEDIDO N-000{{$item->id}} 
                            </div>
                            <div class="col-2">
                                {{$item->order_at}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row pb-2 mt-5 mx-5 pl-5 ">
                                    <div class="col-1 text-center ml-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                        </svg>
                                    </div>
                                    <div class="col">
                                        <h4> Punto de retiro</h4>
                                    </div>
                                </div>
                                
                                <div class="row pt-5  mx-5 pl-5">
                                    <div class="col-1  text-center ml-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                    </div>
                                    <div class="col">
                                        <h4> Punto de entrega</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 text-center">
                                    <h5 class="card-title">Costo del viaje: ${{envioRepartidorCosto($item->order_id,$item->store_id)}}</h5>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Aceptar</button>
                            </div>
                            <div class="col-6">
                                <!----INICIO-DESTINO--->
                                <input  type="hidden" id="inicio2" name="address_address" class="form-control map-input" value="{{$item->store->address->address_longitude}}">
                                <input type="hidden" id="inicio3" name="address_address" class="form-control map-input" value="{{$item->store->address->address_latitude}}">
                                <!----FIN-DESTINO--->
                                
                                <!----INICIO-SUNDO DESTINO--->
                                <input  type="hidden" id="destino2" name="address_address" class="form-control map-input" value="{{$item->orden->user->address->address_longitude}}">
                                <input  type="hidden" id="destino3" name="address_address" class="form-control map-input" value="{{$item->orden->user->address->address_latitude}}">
                                <!----FIN-SUNDO DESTINO--->
                                <div id='map' style='width: 100%; height: 300px;'></div>
                            </div>
                        </div>
                    </div>
                </div>  
            </form>
            @endforeach
        @else
            <h1 class="display-4 text-center">No hay ordenes disponibles.</h1>
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