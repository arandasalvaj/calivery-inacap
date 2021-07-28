@extends('layouts.app')

@section('content')
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
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url(https://i.ibb.co/qCfbkbX/Calama-letras-volum-tricas.jpg);">
              </div>
                    <div class="login-wrap p-4 p-md-5">
                  <div class="d-flex">
                      <div class="w-100">
                          <h3 class="mb-4">Iniciar Sesion</h3>
                      </div>
                  </div>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
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
                    <label class="label" for="password">Contraseña</label>
                  <input type="password"id="password"  class="form-control"  @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Iniciar</button>
                </div>
                <div class="form-group d-md-flex">
                    <div class="w-50 text-left">
                        <label class="checkbox-wrap checkbox-primary mb-0">Recuerdame
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="w-50 text-md-right">
                        <a href="#">Olvide mi contraseña</a>
                    </div>
                </div>
              </form>
              @if (Route::has('register'))
              <p class="text-center">No eres miembro? <a href="{{ route('register') }}">Unete</a></p>
              @endif
              
            </div>
          </div>
            </div>
        </div>
    </div>
</section>
@endsection
