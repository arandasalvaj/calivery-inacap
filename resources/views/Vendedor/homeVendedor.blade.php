@extends('Vendedor.layouts.layoutsV')

@section('contenido')
<div class="container">
    @hasrole('Seller')
    <div class="card text-center">
        <div class="card-header">
          AVISO
        </div>
        <div class="card-body">
          <h5 class="card-title">IMPORTANTE</h5>
          <p class="card-text">Primero debes crear tu tienda para poder vender tus productos, presiona el boton "Crear Tienda"</p>
            <form action="{{route('tienda.create')}}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg btn-block">Crear Tienda</button>
            </form>
            
        </div>
    </div>
    @endhasrole
    @hasrole('Store')
<div class="container">
    <div class="row mx-auto">
        <div class=" col-md-12 col-lg-4 py-2">
        <div class="card shadow mr-2" style="width: 22rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 mt-3 px-5 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                        </svg>
                    </div>
                    <div class="col-8 ">
                        <h5 class="card-title text-center">Productos Activos</h5>
                        <div class="col pl-5">
                            <span class="badge badge-pill badge-success" style="width: 5rem; height: 3rem;">
                                <h2>
                                    @if (!estadoProducto()==null)
                                        {{estadoProducto()}}         
                                    @else
                                        0
                                    @endif    
                                </h2></span>
                        </div>
                    </div>
                </div>
                <hr >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                  </svg>
                <a href="http://"> Productos</a>
            </div>
        </div>
    </div>
    <div class="col-md-12  col-lg-4 py-2">
        <div class="card shadow mr-2" style="width: 22rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 mt-3 px-5 ">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" width="80" height="80" data-icon="box-full" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-box-full fa-w-20 fa-5x">
                            <path fill="currentColor" d="M638.3 239.8L586.8 137c-2.8-5.6-8.5-9-14.6-9-1 0 4.3-.7-56.3 7l26.2-71.8c6-16.6-2.5-35-19.1-41L467.3 1.9c-16.5-6-34.9 2.5-41 19.1l-42.8 117.7C380.7 61.7 317.7 0 240 0 164.7 0 103.7 58 97.3 131.6 67.8 127.8 69 128 67.8 128c-6.1 0-11.8 3.5-14.6 9L1.7 239.8c-4.6 9.2.3 20.2 10.1 23L64 277.7V425c0 14.7 10 27.5 24.2 31l216.2 54.1c13.6 3.4 25 1.5 31 0L551.8 456c14.2-3.6 24.2-16.4 24.2-31V277.7l52.1-14.9c9.9-2.8 14.7-13.8 10.2-23zM456.4 32L512 52.2l-31.8 87.3-66 8.4L456.4 32zM38.8 237.3l38-76 190.4 24.3-60.1 99.8-168.3-48.1zM304 477L96 425V286.9C219.3 322.1 211 320 214.3 320c5.6 0 11-2.9 14-7.9L304 186.5V477zm16-317c-95.7-12.2-154.6-19.7-191.1-24.4C133.2 77.8 181.1 32 240 32c61.8 0 112 50.2 112 112 0 4.1-.6 8.1-1.1 12.1L320 160zm224 265l-208 52V186.5L411.7 312c3 5 8.4 7.9 14 7.9 3.3 0-5.2 2.1 118.3-33.1V425zM432.9 285.3l-60.1-99.8 190.4-24.3 38 76-168.3 48.1z" class="">
                            </path>
                        </svg>
                    </div>
                    <div class="col-8 ">
                        <h5 class="card-title text-center">Total de ordenes</h5>
                        <div class="col pl-5">
                            <span class="badge badge-pill badge-success" style="width: 5rem; height: 3rem;">
                                <h2>
                                    @if (!totalOrdenesPanel()==null)
                                        {{totalOrdenesPanel()}}
                                    @else
                                        0
                                    @endif  
                                </h2></span>
                        </div>
                    </div>
                </div>
                <hr >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                  </svg>
                <a href="http://"> Ordenes</a>
            </div>
        </div>
    </div>
    <div class="col-md-12  col-lg-4 py-2">
        <div class="card shadow mr-2" style="width: 22rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 mt-3 px-5 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                          </svg>
                    </div>
                    <div class="col-8 ">
                        <h5 class="card-title text-center">Compras del dia</h5>
                        <div class="col pl-5">
                            <span class="badge badge-pill badge-success" style="width: 5rem; height: 3rem;">
                                <h2>
                                    @if (!totalOrdenHoy()==null)
                                        {{totalOrdenHoy()}}
                                    @else
                                        0
                                    @endif  
                                </h2></span>
                        </div>
                    </div>
                </div>
                <hr >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                  </svg>
                <a href="http://">Productos</a>
            </div>
        </div>
    </div>


    </div>
</div>
    <section>
        <div class="container">
            <div class="row">
                <div class=" col-md-12 col-lg-6">
                    <div class="row my-4">
                    <div class="card mr-2 pt-5 shadow">
                        <div class="card-body">
                            <canvas id="khe" width="500" height="550"></canvas>
                        </div>
                    </div>
                    </div>
                </div>
                <div class=" col-md-12 col-lg-6">
                    <div class="row my-4">
                        <div class="card shadow">
                            <div class="card-body">
                            <canvas id="como" width="490" height="240" ></canvas>  
                            </div>
                        </div>
                        <div class="card mt-3 pb-2 shadow">
                            <div class="card-body">
                               <canvas id="myChart1" width="490" height="240"></canvas>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endhasrole
</div>
@endsection
@section('scripts')

<script>



    var ctx = document.getElementById('khe').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Audifonos Aux','Cargador punta azul','Mouse inalambrico'],
            datasets: [{
                label: 'Productos mas vendidos',
                data: [300, 50, 100],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
    });

</script>
<script>
    var ctx = document.getElementById('como').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data:{
            labels: ['Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
            datasets: [{
                label: 'Ventas mensuales',
                backgroundColor:'rgb(255,99,132)',
                bordeColor: 'rgb(255,99,132)',
                data:[0,0,0,0,0,30,45]
            }]
        },
        options:{}
    });
</script>
<script>
    var ctx = document.getElementById('myChart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'],
            datasets: [{
                label: 'Venta semanal  ',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection