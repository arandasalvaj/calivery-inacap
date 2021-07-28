@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-5 mb-5">
    <div class="container pt-5 pb-5">
        @if(contadorCart()==0)
            <h1 class="display-1 text-center">Carro Vacio!</h1>
        @else
        <div class="row">
            
        <h1 class="py-2">Carro({{contadorCart()}})</h1>
        <div class="col-sm-12 bg-light">
            <table class="table table-striped">
                <thead>
                <th><div class="col  ml-2">Imagen</div></th>
                <th><div class="col  ml-2">Nombre</div></th>
                <th><div class="col  ml-2">Precio</div></th>
                <th><div class="col  ml-4">Cantidad</div></th>
                <th><div class="col  ml-2">Subtotal</div></th>
                </thead>
                <tbody>
                    @foreach (productosCart() as $Cart)
                    <tr>
                        <td>
                            <div class="card" style="width: 100px;">
                                <div class="card-body">
                                    <img height="60px" src="{{asset($Cart->productos->img)}}" class="card-img-top" alt="">
                                </div>
                              </div>
                        </td>
                        <td>
                            <div class="col mt-2">
                                <div class="row">
                                    <div class="col-12 my-auto ">
                                        <a href="{{route('cliente.product.detalle',$Cart->productos->id)}}"><h6 class="d-inline" >{{$Cart->productos->name}}</h6></a> 
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><div class="col mt-2">
                                <div class="row">
                                    <div class="col-6 my-auto ">
                                        <h6 class="d-inline" >${{number_format($Cart->productos->price,0)}}</h6>  
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="col">
                            <form action="{{route('cart.update',$Cart)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-4 my-auto">
                                        <input type="number" name="quantity" min="1" max="{{$Cart->productos->stock}}" value="{{$Cart->quantity}}">
                                    </div>
                                <input type="hidden" name="price" value="{{$Cart->productos->price}}">
                                <div class="div ml-4">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form> 
                        </div>  
                        </div>     
                        </td>
                        <td>
                            <div class="col">
                                <form action="{{route('cart.destroy',$Cart->id)}}" method="POST">
                                      
                                    @csrf
                                    @method('DELETE')
                                <div class="row">
                                    <div class="col-6 my-auto">
                                        <h6 class="d-inline" >${{number_format($Cart->subtotal,0)}}</h6> 
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </td>
                    </tr>    
                    @endforeach                   
                </tbody>
            </table>
            <div class="card">
                <div class="card-body ">
                    <form action="{{route('orden.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{$Cart->carros->id}}">
                        <div class="row mt-2 ">
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
                        <input type="hidden" name="total" value="{{$Cart->carros->total}}">
                        <input type="hidden" name="envio" value="{{precioEnvioTotal()}}">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection