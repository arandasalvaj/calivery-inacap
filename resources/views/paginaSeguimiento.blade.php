@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-5">
<div class="container pt-5">
    <h1 class="text-center">Ingrese numero de seguimiento</h1>
    <form action="{{route('seguimiento.resultado')}}" method="POST">
    @csrf
        <div class="form-group">
            <input type="text" class="form-control"placeholder="Ingrese numero de seguimiento" name="numero">
        </div>
        <button type="submit" class="btn-primary btn-lg btn-block">Buscar</button>
    </form>
</div>
</section>

@endsection