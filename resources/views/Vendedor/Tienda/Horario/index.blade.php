@extends('Vendedor.layouts.layoutsV')

@section('contenido')
<section>
    <div class="container">
        <div class="div pb-5">
            <a href="{{route('tienda.horario.crear')}}" class="btn btn-outline-primary btn-lg btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
            Agregar Horario
            </a>
        </div>
        @if(!existeHorario())
            <h1 class="display-4 text-center">No Hay horario</h1>
        @endif
        @if(existeHorario())
        <h1 class="display-4 text-center pb-5">Tu Horario</h1>   
        <div class="row">
            <div class="col-sm-12 d-md-none ">
                <div class="card " style="width: 100%;">
                    <div class="card-header text-center">
                        <h5>Horario verano</h1>
                      </div>
                    <div class="card-body text-center">
                      <h5 class="card-title"><strong>Dias</strong></h5>
                        <p class="card-text text-center">
                          <h5 class="mx-5">  
                            @foreach (isset($storeTime)?$storeTime:'' as $time)
                                 {{isset($time->day)?$time->day:''}}
                            @endforeach
                            </h5>  
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item text-center"><strong>Inicio</strong> <h5 class="">{{isset($ini)?$ini:''}}</h3><strong>Cierre</strong> <h5 class="">{{isset($term)?$term:''}}</h5> </li>
                    </ul>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-6">
                                <form  action="{{route('horario.edit',$storeT->id)}}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <form action="{{route('horario.destroy',$storeT->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="d-none d-md-block col-md col-lg-12 ">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 ">
                                <h4 class="text-center">Nombre</h3>
                            </div>
                            <div class="col-3">
                                <h4 class="text-center">Dias</h3>
                            </div>
                            <div class="col-2 ">
                                <h4 class="text-center">Inicio</h3>
                            </div>
                            <div class="col-2 ">
                                <h4 class="text-center">Cierre</h3>
                            </div>
                            <div class="col-2">
                                <h4 class="text-center">Accion</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5 mb-5">
                            <div class="col-3 ">
                                <div class="col">
                                    <h5>{{$storeT->name}}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row ">
                                    @foreach (isset($storeTime)?$storeTime:'' as $time)
                                     <h5 class="mx-2 ">{{isset($time->day)?$time->day:''}}</h3>    
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <h5 class="">{{isset($ini)?$ini:''}}</h3>
                            </div>
                            <div class="col-2  text-center">
                                <h5 class="">{{isset($term)?$term:''}}</h3>
                            </div>
                            <div class="col-2 ">
                                <div class="row">
                                    <div class="col col-lg-6 mt-2">
                                        <form  action="{{route('horario.edit',$storeT->id)}}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>
                                    </div>
                                    <div class="col col-lg-6 mt-2">
                                        <form action="{{route('horario.destroy',$storeT->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
    </section>
@endsection
