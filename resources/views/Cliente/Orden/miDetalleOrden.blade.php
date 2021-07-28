@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-5">
    <div class="container pt-5">
        <div class="row my-4 ">
            <div class="col-6 px-auto ">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body px-5 pb-5">
                        <div class="d-flex justify-content-around">
                            <div class="col-12 py-1">
                                <h3>Datos de Contacto</h3>
                               <h6>Nombre: {{Auth::user()->name}}</h6> 
                               <h6>Telefono:+569{{Auth::user()->cellphone}}</h6> 
                            </div>
                        </div>
                        <div class="float-none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 px-auto">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body px-5">
                        <div class="d-flex justify-content-around">
                            <div class="col-12 py-1">
                                <h3>Datos de envio</h3>
                               <h6>Dirección: {{Auth::user()->address->name}}</h6> 
                        
                               <div class="text-center">
                                <a href="#" class="btn btn-outline-primary btn-lg btn-block">Ver Seguimiento</a>   
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="px-5">
        <div class="row shadow p-4 bg-white rounded mx-5 ">
            <h1 class="m-3">Resumen de la compra</h1>
            <hr>
            <table class="table table-striped">
                <thead>
                <th><div class="col ">Imagen</div></th>
                <th><div class="col ">Nombre</div></th>
                <th><div class="col ">Precio</div></th>
                <th><div class="col ">Cantidad</div></th>
                <th><div class="col  ">Subtotal</div></th>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <div class="card" style="width: 100px;">
                                <div class="card-body ">
                                    <img height="60px" src="{{asset($item->img)}}" class="card-img-top " alt="{{$item->name}}">
                                </div>
                              </div>
                        </td>
                        <td>
                            <div class="col">
                                <div class="row">
                                    <div class="col-11">
                                        <h6 class="d-inline" >{{$item->name}}</h6> 
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><div class="col ">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="d-inline" >${{number_format($item->price,0)}}</h6>  
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col">
                                <div class="row">
                                    <div class="col-4 pl-5">
                                        <h6 class="d-inline" >{{$item->quantity}}</h6> 
                                    </div>
                                </div>  
                            </div>     
                        </td>
                        <td>
                            <div class="col ">
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="d-inline" >{{number_format($item->quantity*$item->price,0)}}</h6> 
                                    </div>
                                </div>  
                            </div>     
                        </td>
                    </tr>    
                    @endforeach                   
                </tbody>
            </table>
            <div class="col">
                <div class="row my-5 mx-5 px-2 ">
                    <div class="col-12 ">
                        <div class="div text-center">
                            <div class="container ">
                                <hr class="my-auto flex-grow-1 ">
                            </div>
                            <div class="row mt-2 ">
                                <div class="col-6">
                                    <h5>Subtotal:</h5>
                                </div>
                                <div class="col-6">
                                    <h5>${{number_format($orden->total)}}</h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <h5>Envío:</h5>
                                </div>
                                <div class="col-6">
                                    <h5>$</h5>
                                </div>
                            </div>
                            <hr class="my-auto flex-grow-1 pt-3">
                            <div class="row">
                                <div class="col-6">
                                    <h4>Total:</h4>
                                </div>
                                <div class="col-6">
                                    <h5>${{number_format($orden->total)}}</h5>
                                </div>
                            </div>
                        </div>
                            <div class="div">
                                <a href="{{ route('ordenesCliente') }}" class="btn btn-primary btn-lg btn-block">Volver Atras</a>
                            </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</section>

@endsection    