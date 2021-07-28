@extends('Vendedor.layouts.layoutsV')

@section('contenido')
<section>
    <div class="container">
        <div class="row">
            @hasrole('Store')
        <div class="col-8 mx-auto">
            <h3 class="display-4 mb-5 text-center">Registra un Horario</h3>
            <form enctype="multipart/form-data" action="{{route('tienda.horario.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre del horario" name="name" value="{{tiempo()}}">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" id="start"  class="form-control" name="fechaInicio" min="{{tiempoHoy()}}"  max="3000-12-31" value="{{tiempoHoy()}} ">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Horario Inicio</label>
                            <input type="time" class="form-control" name="horarioInicio" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha Termino</label>
                            <input type="date" id="start"  class="form-control" name="fechaTermino" min="{{tiempoHoy()}}"  max="{{tiempoSemana()}}" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Horario Termino</label>
                            <input type="time" class="form-control" name="horariotermino" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Registrar horario</button>
            </form>
            </div>
            @endhasrole
        </div>
    </div>
</section>
<script>
    $('#datetimepicker').data("DateTimePicker").FUNCTION()
</script>
@endsection