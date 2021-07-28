<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .ftco-section {
      padding: 7em 0; }
    
    .ftco-no-pt {
      padding-top: 0; }
    
    .ftco-no-pb {
      padding-bottom: 0; }
    
    .heading-section {
      font-size: 28px;
      color: #000; }
    
    .img {
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center; }
    
    .wrap {
      width: 100%;
      overflow: hidden;
      background: #fff;
      border-radius: 5px;
      -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
      -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
      box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24); }
    
    .img, .login-wrap {
      width: 50%; }
      @media (max-width: 991.98px) {
        .img, .login-wrap {
          width: 100%; } }
    
    @media (max-width: 767.98px) {
      .wrap .img {
        height: 250px; } }
    
    .login-wrap {
      position: relative;
      background: #fff h3;
        background-font-weight: 300; }
    
    .form-group {
      position: relative; }
      .form-group .label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #000;
        font-weight: 700; }
      .form-group a {
        color: gray; }
    
    .form-control {
      height: 48px;
      background: #fff;
      color: #000;
      font-size: 16px;
      border-radius: 5px;
      -webkit-box-shadow: none;
      box-shadow: none;
      border: 1px solid rgba(0, 0, 0, 0.1); }
      .form-control::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: rgba(0, 0, 0, 0.2) !important; }
      .form-control::-moz-placeholder {
        /* Firefox 19+ */
        color: rgba(0, 0, 0, 0.2) !important; }
      .form-control:-ms-input-placeholder {
        /* IE 10+ */
        color: rgba(0, 0, 0, 0.2) !important; }
      .form-control:-moz-placeholder {
        /* Firefox 18- */
        color: rgba(0, 0, 0, 0.2) !important; }
      .form-control:focus, .form-control:active {
        outline: none !important;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #e3b04b; }
    
    </style>
</head>
<body>
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>