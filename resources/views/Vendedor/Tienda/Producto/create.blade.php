@extends('Vendedor.layouts.layoutsV')

@section('contenido')
@hasrole('Store')
<div class="container">
    <div class="col-8 mx-auto">
    <h3 class="display-4 mb-5 text-center">Registra un producto</h3>
    <form enctype="multipart/form-data" action="{{route('producto.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre del producto" name="nombre">
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" class="form-control"  placeholder="Stock del producto" name="stock">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mx-auto">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="number" class="form-control"   placeholder="Precio del producto" name="precio">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Detalle</label><small> (Hasta 1000 caracteres)</small>
            <textarea name="detalle" id="summernote" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Categoria</label>
            <select class="form-control" id="exampleFormControlSelect1" name="categoria">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>      
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Imagen</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="validatedCustomFile" required name="img">
              <label class="custom-file-label" for="validatedCustomFile">Seleccione imagen del producto</label>
            </div>
          </div>
        <button type="submit" class="btn btn-success btn-lg btn-block">Registrar producto</button>
    </form>
    </div>
</div>
@endhasrole
@endsection


