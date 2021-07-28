@extends('Vendedor.layouts.layoutsV')

@section('contenido')   

    <section class="pt-5">
      <div class="container pt-5">
        <div class="row">
            <div class="col-12">
              @if (estadoOrdenes())
                  <div class="">
                    <h1 class="display-4 text-center">No tienes ordenes</h1>
                  </div>
              @else
                <div class="">
                  <h1 class="display-4 text-center">Tus ordenes</h1>
                </div>
                @foreach (TotalOrdenesNoConfirmadas() as $orden)

                <div class="card my-4">
                  <div class="card-header">
                    N° de pedido 0000{{$orden->id}}
                  </div>
                    <div class="card-body">
                      <div class="row">
                        @if ($orden->status==0)
                          <div class="col-3">
                            <div class="div text-center">
                              <div class="col">
                                <span class="badge badge-warning">Pendiente</span>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-bag-dash" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5.5 10a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                              </svg>
                            </div>
                          </div>
                          @endif
                          @if ($orden->status==1 ||$orden->status==3||$orden->status==4)
                          <div class="col-3">
                            <div class="div text-center">
                              <div class="col">
                                <span class="badge badge-success">Aprobado</span>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                              </svg>
                            </div>
                          </div>
                          @endif
                          @if ($orden->status==2)
                          <div class="col-3">
                            <div class="div text-center">
                              <div class="col">
                                <span class="badge badge-danger">No aprobado</span>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-bag-x" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                              </svg>
                            </div>
                          </div>
                          @endif
                          <div class="col-6">
                            <div class="col">
                              <span>Fecha de pedido {{$orden->order_at}}</span>
                            </div>
                            <div class="col">
                              <span>Articulos {{number_format(cantidadProductosOrden($orden->id))}}</span>
                            </div>
                            
                           <div class="col">
                            <span>Total de pedido ${{number_format($orden->total,0)}}</span>
                           </div>
                          </div>
                          <div class="col-3">
                            <div class="div py-3 text-center">
                              <a href="{{route('tienda.orden.detalle',$orden->orden->id)}}" class="btn btn-primary">Ver Compra</a>  
                            </div>
                            @if($orden->status==3)
                            <div class="div py-3 text-center">
                              <button class="btn btn-success">Confirmado</button> 
                            </div>
                            @endif
                            @if($orden->status==4)
                                <div class="div py-3 text-center">
                                  <a href="#" class="btn btn-outline-primary">Seguimiento</a>  
                                </div> 
                            @endif

                            @if($orden->status==1)
                              <div class="div py-3 text-center">
                                <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">No Confirmado</button> 
                              </div>
                              <!-------INICIO MODAL---->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Confirmación de despacho</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      </div>
                                      <div class="modal-body">
                                        <span>¿Estas seguro que deseas confirmar el despacho de esta orden?</span>
                                        <span>(Cambio irreversible)</span>
                                      </div>
                                      <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                      <form action="{{route('tienda.orden.status',buscarOrden($orden->orden->id))}}" method="POST">
                                          @csrf
                                          <button type="submit" class="btn btn-primary">Confirmar</button>
                                      </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            <!-------TERMINO MODAL----> 
                            @endif
                            
                          </div>
                        </div>
                    </div>
                </div>
                @endforeach
              @endif
            </div>
        </div>
        </div>
    </section>

















    @endsection