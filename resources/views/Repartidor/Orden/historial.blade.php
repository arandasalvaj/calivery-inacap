@extends('Repartidor.layouts.layoutsR')

@section('contenido')
<section>
    <div class="container">
      <h1 class="display-4 text-center">Mi Saldo</h1>
      <h1 class="display-4 text-center pt-3 text-danger">${{number_format(saldoRepartidor(),0)}}</h1>
        <div class="row py-5">
          <div class="col">
            <table class="table table-striped bordered" id="myTable">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Envio</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody >
                  @foreach (buscarHistorialDelivery() as $envio)
                      <tr>
                          <th>000{{$envio->id}}</th>
                          <th>{{$envio->created_at}}</th>
                          <th>{{$envio->user->name}} {{$envio->user->lastname}}</th>
                          <th>{{$envio->ordenStore->store->name}}</th>
                          <th>${{number_format($envio->shipping_cost,0)}}</th>
                          <th>
                            <div class="col-3">
                              <div class="div text-center">
                                <div class="col">
                                  <span class="badge badge-success">Entregado</span>
                                </div>
                              </div>
                            </div>
                          </th>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
</section>
@endsection