@extends('layouts.appLog')

@section('content')
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                             <div class="container">
                                <div class="form-signin" role="form">
                                    <h3 class="form-signin-heading">Ingrese los datos:</h3>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
							
                                <button class="btn btn-danger" id="singin" type="submit">
                                    {{ __('Login') }}
                                </button>
                              
                       
                            </div>
                            <div class="container" id="resultado">
    
                            </div>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
