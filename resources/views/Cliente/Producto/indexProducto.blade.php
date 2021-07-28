@extends('Cliente.layouts.layoutsC')

@section('contenido')
    <div class="container">
        <section>
            <div class="container bg-white pt-5">
                <section>
                    <div class="container pt-5">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('cliente.categoria.producto',$producto->categoria->id)}}">{{$producto->categoria->name}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{($producto->name)}}</li>
                        </ol>
                        </nav>
                    </div>
                </section>
                <section>   
                    <div class="continer ">
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <img src="{{asset($producto->img)}}"class="img-fluid img-thumbnail mx-auto d-block" >
                            </div>
                            <div class="card ml-5 mx-auto" style="width: 25rem;" >
                                <div class="card-body">
                                    <h3 class="pb-3">{{($producto->name)}}</h3>   
                                    <h5 class="pt-2 pb-3">Precio: <strong class="text-danger">${{number_format($producto->price,0)}}</strong></h5>
                                    @if(!Auth::user()==null)
                                        @if(CantidadEnvioProducto($producto->store_id)>=2)
                                            <span class="pt-2 pb-3">Envio: <strong class="text-danger">${{number_format(500,0)}} c/u</strong></span><small> (Envio total: ${{precioEnvioOrden($producto->store_id)}})</small>
                                        @endif
                                        @if(CantidadEnvioProducto($producto->store_id)==1 || CantidadEnvioProducto($producto->store_id)==0)
                                            <span class="pt-2 pb-3">Envio: <strong class="text-danger">${{number_format(1500,0)}}</strong></span> <small>(Sobre 1 Unidad, <strong class="text-danger">$500 </strong>c/u)</small>
                                        @endif
                                    @else
                                        <span class="pt-2 pb-3">Envio: <strong class="text-danger">${{number_format(1500,0)}}</strong></span> <small>(Sobre 1 Unidad, <strong class="text-danger">$500 </strong>c/u)</small>
                                    @endif

                                    <hr style="border: 1px solid #8d8a8a;" >
                                    
                                    <h6 class="pt-2 pb-1">Vendido por: <a href="{{route('cliente.tienda.info',$producto->store_id)}}">{{(store($producto->store_id)->name)}}</a></h3>
                                    @if ($producto->stock<5)
                                        <h5 class="pt-2"><strong class="text-success ">Pocas unidades disponibles</strong></h5>
                                    @else
                                        <h5 class="pt-2"><strong class="text-success ">Stock disponible</strong></h5>
                                    @endif
                                    <form action="{{ route('cart.store')}}" method="post">
                                        @csrf 
                                        <input type="hidden" name="product_id" value="{{$producto->id}}">
                                        <div class="py-3">
                                            <h6>Cantidad: <input class="py-2" placeholder="" required type="number" name="quantity" min="1" max="{{($producto->stock)}}" value="1"> <small>(Disponible {{($producto->stock)}} unidades)</small></h6>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Agregar al carro</button>
                                    </form>
                                    <h5 class="pt-4 pb-3">Categoria: <strong><a href="">{{$producto->categoria->name}}</a></strong></h5>
                                    <hr style="border: 1px solid #8d8a8a;">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container pt-5">
                        <div class="row">
                            <h1 class="">Descripción</h3>
                        </div>
                    </div>
                </section>
                <hr style="border: 1px solid #8d8a8a;">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h2 class="display-5">{{($producto->name)}}</h2>
                                <p class="card-text">{!!$producto->detail!!}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <hr style="border: 1px solid #8d8a8a;">
                
                <section>
                    <div class="bbb_viewed" style="border: none; background-color: rgba(255, 0, 0, 0);">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bbb_main_container" style="border: none; background-color: rgba(255, 0, 0, 0);">
                                        <div class="bbb_viewed_title_container"style="border: none; background-color: rgba(255, 0, 0, 0);">
                                            <h3 class="bbb_viewed_title">Otros productos similares</h3>
                                        </div>
                                        <div class="bbb_viewed_slider_container"style="border: none; background-color: rgba(255, 0, 0, 0);">
                                            <div class="owl-carousel owl-theme bbb_viewed_slider"style="border: none; background-color: rgba(255, 0, 0, 0);">
                                                 @foreach (productosCategoria($producto->category_id) as $product)  
                                                <div class="owl-item">
                                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center"style="border: none; background-color: rgba(255, 0, 0, 0);">
                                                        <div class="bbb_viewed_image" style="border: none; background-color: rgba(255, 0, 0, 0);"><a href="{{route('cliente.product.detalle',$product->id)}}"><img src="{{asset($product->img)}}" alt=""></a></div>
                                                        <div class="bbb_viewed_content text-center"style="border: none; background-color: rgba(255, 0, 0, 0);">
                                                            <div class="bbb_viewed_price">${{number_format($product->price,0)}}</div>
                                                            <div class="bbb_viewed_name"><a href="{{route('cliente.product.detalle',$product->id)}}">{{(str_limit($product->name))}}</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
    </div>
@endsection
