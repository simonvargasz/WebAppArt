@extends('layout/layout')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="row">
        <div class="col-12 d-flex m-0">
            <div class="btn-group">
                <button class="btn btn-secondary btn-lg dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-filter"></i>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item fs-5 fw-bold">Filtrar por Artista:</li>
                    @foreach ($artistas as $artista)
                    <li><a class="dropdown-item" href="{{ route('filtered',['user' => $artista->user]) }}">{{$artista->nombre}} {{$artista->apellido}}</a></li>
                    @endforeach
                </ul>
              </div>
        </div>
        @foreach ($imagenes as $imagen)
        <div class="col-auto mt-4 d-flex">
            <div class="card p-0" style="width: 18rem;">
                <img src="{{ asset('images/'. $imagen->archivo) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$imagen->titulo}}</h5>
                    <p class="card-text">Autor: {{$imagen->cuenta->nombre}} {{$imagen->cuenta->apellido}}</p>
                    
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
@endsection