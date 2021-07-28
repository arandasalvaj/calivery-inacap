@extends('Cliente.layouts.layoutsC')

@section('contenido')
@php
// SDK de Mercado Pago
require base_path('/vendor/autoload.php');
// Agrega credenciales
MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$shipments = new MercadoPago\Shipments();
$shipments->cost=$order->shipping_cost;
$shipments->mode="not_specified";
$preference->shipments=$shipments;
// Crea un ítem en la preferencia
foreach ($items as $producto) {
    $item = new MercadoPago\Item();
    $item->title = $producto->name;
    $item->quantity = $producto->quantity;
    $item->unit_price = $producto->price;

    $productos[]=$item;
}
$preference->back_urls = array(
    "success" => route('orden.pay',$order),
    "failure" => route('orden.pay',$order),
    "pending" => route('orden.pay',$order)
);
$preference->auto_return = "approved";
$preference->items = $productos;
$preference->save();
@endphp

<div class="container-fluid px-5 py-4 mb-5">
    <section class="pt-5 px-5">
        <div class="row pt-5">
            <div class="col-12">
                <div class="card shadow"style="border-radius: 15px;">
                    <div class="card-body px-5">
                        <h3>NÚMERO DE ORDEN: ORDEN-{{$order->id}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row mt-4 pt-2 px-5 ">
        <div class="col-12 pb-5">
            <div class="card shadow px-3 " style="border-radius: 15px;">
                <div class="card-body px-5">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="text-center py-2">
                                <h3>Envío</h3>
                                <h6>Los productos seran enviados a:</h6> 
                                <h6>, Calama</h6> 
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="text-center py-2">
                                <h3>Datos de Contacto</h3>
                                <h6>Persona que recibirá el producto: {{Auth::user()->name}} {{Auth::user()->lastname}}</h6> 
                                <h6>Teléfono de contacto:+569{{Auth::user()->cellphone}}</h6> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row shadow p-4 bg-white mx-5 mb-5" style="border-radius: 15px;">
        <h1 class="m-3">Resumen</h1>
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
        <hr>
        
        <div class="col-12">
            <div class="card ">
                <div class="card-body px-5">
                    <div class="float-right">
                        <h6>Subtotal: ${{number_format($order->total,0)}}</h6>
                        <h6>Total de Envio: ${{number_format($order->shipping_cost,0)}}</h6>
                        <h3>Total: ${{number_format($order->total+$order->shipping_cost,0)}}</h3>
                        <div class="cho-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    // Agrega credenciales de SDK
      const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-AR'
      });
    
      // Inicializa el checkout
      mp.checkout({
          preference: {
              id: '{{$preference->id}}'
          },
          render: {
                container: '.cho-container', // Indica dónde se mostrará el botón de pago
                label: 'Pagar', // Cambia el texto del botón de pago (opcional)
          }
    });
    </script>
@endsection    