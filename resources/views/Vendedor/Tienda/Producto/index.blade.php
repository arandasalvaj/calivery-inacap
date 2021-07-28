@extends('Vendedor.layouts.layoutsV')

@section('contenido')
@hasrole('Store')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alerta1" role="alert">
            <strong>{{session()->get('success')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <a href="{{route('producto.create')}}" class="btn btn-outline-primary btn-lg btn-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
        <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
      </svg> Agregar Producto</a>
    <h1 class="display-4 text-center mt-5 mb-5">Listado de productos</h1>  
    <table class="table table-striped bordered" id="myTable">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody >
            @foreach ($productos as $producto)
                <tr>
                    <th>{{isset($producto->id)?$producto->id:''}}</th>
                    <th>
                        <div class="card" style="width: 100px;">
                            <div class="card-body">
                                <img height="60px" src="{{asset($producto->img)}}" class="card-img-top" alt="">
                            </div>
                          </div>
                    </th>
                    <td>{{isset($producto->name)?$producto->name:''}}</td>
                    <td>{{isset($producto->stock)?$producto->stock:''}}</td>
                    <td>${{number_format(isset($producto->price)?$producto->price:'')}}</td>
                    <form action="{{route('tienda.producto.status',$producto->id)}}" method="POST">
                        @csrf
                        @if (estadoCambioProducto($producto->id))
                            <td><button type="submit" class="btn btn-success mt-2">Activo</button></td>   
                        @else
                            <td><button type="submit" class="btn btn-danger mt-2">Desactivado</button></td>   
                        @endif
                    </form>
                    <td>
                        <div class="row">
                            <div class="col col-lg-6 mt-2">
                                <form action="{{route('producto.destroy',isset($producto->id)?$producto->id:'')}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Eliminar</button>
                                </form>
                            </div>
                            <div class="col col-lg-6 mt-2">
                                <form  action="{{route('producto.edit',isset($producto->id)?$producto->id:'')}}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                            </div>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endhasrole
@section('scripts')
@if(Session::has('success_add'))
    <script>
        toastr.success("{!!Session::get('success_add')!!}");
    </script>
@endif
@endsection
@endsection