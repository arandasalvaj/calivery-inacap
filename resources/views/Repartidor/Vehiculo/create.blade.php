
@extends('Repartidor.layouts.layoutsR')

@section('contenido')
<section>
    <div class="container">
        <div class="col-8 mx-auto">
        <h3 class="display-4 mb-5 text-center">Registra tu vehiculo</h3>
        <form enctype="multipart/form-data" action="{{route('repartidor.vehiculo.crear')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">N° de patente</label>
                <input type="text" class="form-control" placeholder="Nombre del producto" name="placa">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo de vehiculo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01 " name="tipo">
                      <option selected>Automovil</option>
                      <option value="">Bicicleta</option>
                    </select>
                  </div>

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Imagen de tu vehiculo</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="validatedCustomFile" required name="img">
                  <label class="custom-file-label" for="validatedCustomFile">Seleccione imagen tu vehiculo</label>
                </div>
              </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">Registrar vehiculo</button>
        </form>
        </div>
    </div>
</section>
@endsection





