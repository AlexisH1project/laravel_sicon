@extends('layouts.appSICON')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SICONs</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="banner-img">
           <img src="resource/images/ss2.png" width="35%" height="25%" alt="logoGobMX" vertical-align="center"/>
        </div>
        <br/>
        <br/>
        <br/>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="form">
                        <h:form class="login-form">
                             <div class="container">
                                <div class="form-signin" role="form">
                                    <h3 class="form-signin-heading">Ingrese los datos:</h3>
                                    <input type="text" name = "user" id="usuario" class="form-control" placeholder="usuario" required autofocus>
                                    <input type="password" id="pass" class="form-control" placeholder="contraseña" required>

							     			<br>
										    <br>
							
                                <button class="btn btn-danger" id="singin" type="button">ingresar</button>
                              
                       
                            </div>
                            <div class="container" id="resultado">
    
                            </div>                  
                        </h:form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
