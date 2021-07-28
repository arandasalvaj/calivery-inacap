@extends('Cliente.layouts.layoutsC')

@section('contenido')
<section class="pt-5">
    <div class="container pt-5">
        <div class="row text-center pt-5">
            <div class="col pt-5">
                <h1 class="display-2">Ha ocurrido un fallo en el proceso de pago, vuelve a intentarlo.</h1>
                <div class="row pt-5">
                    <div class="col-6 pt-5">
                        <a href="{{ route('ordenesCliente') }}" class="btn btn-primary">Ir a mis compras</a>
                    </div>
                    <div class="col-6 pt-5">
                        <a href="{{ url('/') }}" class="btn btn-primary">Ir al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection