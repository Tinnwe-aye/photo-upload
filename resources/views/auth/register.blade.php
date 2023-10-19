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

    <title>Laravel</title>
</head>
<body>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('image_name').value = URL.createObjectURL(event.target.files[0]);
        };
    </script>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
    {{-- <a class="navbar-brand" href="#">Laravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> --}}

    {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>

    </div> --}}
    </div>
</nav>
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            {{-- <form name="my-form" onsubmit="return validform()" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"> --}}
                            <form onsubmit="return validform()" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">Login user name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username" value="{{ old('username') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">password</label>
                                    <div class="col-md-6">
                                        <input type="text" id="password" class="form-control" name="password" value="{{ old('password') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">confirm password</label>
                                    <div class="col-md-6">
                                        <input type="text" id="password_confirmation" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>
                                    <div class="col-md-6"> 
                                        @if (session('old_image'))
                                        <img src="{{asset('images/'. session('old_image'))}}" alt="Image" class="img-class" id="output" width="200"> 
                                        <input type="hidden" id="image_name" name="image_name"  value="{{asset('images/'. session('old_image'))}}">
                                        @else                                            
                                            <img id="output" width="200" />  
                                            <input type="hidden" id="image_name" name="image_name"  value="">
                                        @endif 
                                        
                                        <input type="file"  accept="image/*" name="photo" id="file"  onchange="loadFile(event)" style="display: none;">                                     
                                    </div>                                   
                                    <label for="file" style="cursor: pointer;height:40px;" class="btn btn-primary">Select Photo</label>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
