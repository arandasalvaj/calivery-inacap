
@extends('Repartidor.layouts.layoutsR')

@section('contenido')
<section>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{asset(vehiculoRepartidor()->img)}}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Tipo de vehiculo: {{vehiculoRepartidor()->vehicle_type}}</h5>
              <p class="card-text">N° de patente: {{vehiculoRepartidor()->number_plate}}</p>
              <a href="#" class="btn btn-primary">Editar</a>
            </div>
          </div>
    </div>
</section>
@endsection