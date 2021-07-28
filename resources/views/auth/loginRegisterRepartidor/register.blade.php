@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url(https://i.ibb.co/qCfbkbX/Calama-letras-volum-tricas.jpg);">
            </div>
            <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-4">Registro</h3>
                    </div>
                </div>
                    <form method="POST" action="{{ route('registerD') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="label" for="name">Rut</label>
                            <input id="rut" type="rut" class="form-control" @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" placeholder="Rut" required autofocus>
                            @error('rut')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Nombre</label>
                            <input id="name" type="name" class="form-control" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Apellido</label>
                            <input id="lastname" type="lastname" class="form-control" @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" placeholder="Apellido" required autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Email</label>
                            <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="label" for="name">Contraseña</label>
                            <input id="password" type="password" class="form-control" @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Contraseña" required autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="name">Confirmar contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control" @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmar contraseña" required autofocus>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Registrar</button>
                        </div>
                    </form>            
                        <p class="text-center">Eres miembro? <a href="{{ route('login') }}">Inicia sesion</a></p>
                    <hr>
                    @if (Route::has('register'))
                        <p class="text-center">Quieres ser Cliente? <a href="{{ route('register') }}">Registrate</a></p>
                    @endif
                    @if (Route::has('registerS'))
                        <p class="text-center">Quieres ser Vendedor? <a href="{{ route('registerS') }}">Registrate</a></p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
