@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section>
    <div class="container py-5">
        <div class="row mt-5 mx-auto px-auto ">  
           @foreach ($productos as $producto)
           <div class="col-3 mt-3 mx-3 col-4-md col-4-sm">
               <div class="card text-center" style="width: 18rem;">
                   <a href="{{route('cliente.product.detalle',$producto->id)}}"><img class="card-img-top mx-auto" src="{{asset($producto->img)}}" style="width: 10rem; height: 10rem;" alt="{{$producto->name}}"></a>
                   <div class="card-body">
                   <h5 class="card-title"><a href="{{route('cliente.product.detalle',$producto->id)}}" target="{{$producto->name}}">{{str_limit($producto->name)}}</a></h5>
                   <span class="text-danger">${{number_format($producto->price,0)}}</span>
                   <form action="{{ route('cart.store')}}" method="post">
                       @csrf 
                       <input type="hidden" name="product_id" value="{{$producto->id}}">
                       <div class="pb-3 pt-2">
                           <input placeholder="Enter a number" required type="number" name="quantity" min="1" max="{{($producto->stock)}}" value="1">
                       </div>
                   <div class="bbb_viewed_name "><button class="btn btn-primary" type="submit">Agregar al carro</button></div>
                   </form>
       
                   
                   </div>
               </div>
           </div>
           @endforeach
        </div>   
       </div>
       <div class="pagination-block">
           {{$productos->links()}}
       </div>
</section>

@endsection