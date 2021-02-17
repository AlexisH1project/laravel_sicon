@extends('layouts.appLog')
@if(!empty(Auth::user()->id_rol))
<script>window.location = "/home";</script>
@else
@section('content')
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                             <div class="container">
                                <div class="form-signin" role="form">
                                    <center>
                                    <h3 class="form-signin-heading">Ingrese los datos:</h3>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Usuario" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="contraseña" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

							     			<br>
										    <br>

						<!-- **********Recordamos la contraseña en el navegador
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                        </div> -->

                                <button class="btn btn-danger" id="singin" type="submit">
                                    {{ __('Login') }}
                                </button>
                              @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                                </center>
                            </div>
                            <div class="container" id="resultado">
    
                            </div>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@endif
