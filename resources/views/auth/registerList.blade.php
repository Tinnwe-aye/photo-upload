@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <title>Laravel</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
        <a class="navbar-brand" href="#">List Form</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
    
        </div>
        </div>
    </nav>
    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @foreach ($userDatas as $userData)
                    <div class="row" style="position:relative;">
                        <div class="col-sm-3 col-md-5 col-lg-3">
                            <img src="data:image/jpeg;base64,{{ base64_encode($userData->photo_data) }}" alt="Image" class="img-class">
                        </div>
                        <div class="col-sm-3 col-md-5 offset-md-2 col-lg-3 offset-lg-0" style="text-align:left;">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{$userData->name}}</label>
                            <br>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{$userData->email}}</label>
                        </div>
                    </div>
                    <br>
                    @endforeach
            </div>
        </div>
    </main>
</body>
</html>