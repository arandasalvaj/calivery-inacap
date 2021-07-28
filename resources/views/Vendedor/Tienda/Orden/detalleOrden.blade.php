@extends('Vendedor.layouts.layoutsV')

@section('contenido')
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="detalle-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="true">Detalle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="seguimiento-tab" data-toggle="tab" href="#seguimiento" role="tab" aria-controls="seguimiento" aria-selected="false">Seguimiento</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contacto-tab" data-toggle="tab" href="#contacto" role="tab" aria-controls="contacto" aria-selected="false">Cliente</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="detalle" role="tabpanel" aria-labelledby="detalle-tab">
            <!---DETALLE ORDEN--->
            <h1 class="text-center mt-5 mb-5">Listado de productos</h1>
            <table class="table table-striped bordered" id="myTable">
                <thead class="thead-dark text-center">
                    <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($items as $producto)
                        <tr>
                            <th>
                                <div class="card mx-auto" style="width: 100px;">
                                    <div class="card-body">
                                        <img height="60px" src="{{asset($producto->img)}}" class="card-img-top img-thumbnail" alt="">
                                    </div>
                                </div>
                            </th>
                            <td>{{isset($producto->name)?$producto->name:''}}</td>
                            <td>${{number_format($producto->price,0)}}</td>
                            <td>{{$producto->quantity}}</td>
                            <td>${{number_format($producto->quantity*$producto->price, 0 )}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

              <h1 class="text-center mt-5 mb-5">Total de la orden: ${{number_format($orderStore->total,0)}}</h1>
            <!---DETALLE ORDEN--->
        </div>
    <div class="tab-pane fade" id="seguimiento" role="tabpanel" aria-labelledby="seguimiento-tab">
    @if ($orderStore->status==4)
    <!----Aca colocar condicion (true o false) para ver si el pedido esta confirmado por el vendedor para su reparto, order_store, state = 1 (true)---->
               <div class="col-6 px-auto">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body px-5">
                        <div class="d-flex justify-content-around">
                            <div class="col-12 py-1">
                                <h3>Datos de envio</h3>
                                <h6>Dirección:</h6> 
                                <h6>{{$orden->user->address}}</h6> 
                                <div class="text-center">
                                <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ver Seguimiento</a>   
                                </div>
                            </div>
                        </div>
                        <div class="float-none">
                        </div>
                    </div>
                </div>
            </div>
      <!----Termina el if ----> 
    @else
    <h1 class="text-center mt-5 mb-5">Seguimiento no disponible</h1>
    @endif


        

        


   
  
  
    </div>
    <div class="tab-pane fade" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
        <!---------------CONTACTO------------------->   
        <div class="row my-4 ">
            <div class="col-6 px-auto ">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body my-2 py-4">
                        <div class="d-flex justify-content-around">
                            <div>
                                <h3>Datos de Contacto</h3>
                                <h6>Nombre: {{$orden->user->name}} {{$orden->user->lastname}}</h6>
                                <h6>Telefono:+569{{$orden->user->cellphone}}</h6> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <!-----------------------CONTACTO--------------->   
    </div>
    </div>
</div>
@endsection