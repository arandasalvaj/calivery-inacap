@extends('Vendedor.layouts.layoutsV')

@section('contenido')
@hasrole('Store')
<div class="container">
    <h3>Registra un producto</h3>
    <form enctype="multipart/form-data" action="{{route('producto.update',isset($producto->id)?$producto->id:'')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre del producto" name="name" value="{{isset($producto->name)?$producto->name:''}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Stock</label>
            <input type="number" class="form-control"  placeholder="Stock del producto" name="stock" value="{{isset($producto->stock)?$producto->stock:''}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Precio</label>
            <input type="text" class="form-control"   placeholder="Precio del producto" name="price" value="{{isset($producto->price)?$producto->price:''}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Detalle</label><small> (Hasta 1000 caracteres)</small>
            <textarea name="detail" id="summernote" cols="30" rows="10"> </textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Categoria</label>
            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>      
                @endforeach
            </select>
          </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Imagen</label>
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    Imagen Actual
                  </div>
                <img src="{{asset($producto->img)}}" class="img-thumbnail " alt="...">
              </div>
            
            <input type="file" class="form-control-file" name="img" value="{{isset($producto->img)?$producto->img:''}}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Color</label>
            <input type="color" class="form-control-file" name="color" value="{{isset($producto->color)?$producto->color:''}}">
        </div>
        <button type="submit" class="btn btn-success">Registrar producto</button>
    </form>
</div>
@endhasrole
@endsection