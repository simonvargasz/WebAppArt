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
    <div class="row d-flex @if( $imagenes->where('baneada', 0)->count() > 3 ) justify-content-between @endif ">
        <div class="col-12 d-flex m-0">
            <div class="btn-group">
                <button class="btn btn-secondary btn-lg dropdown-toggle rounded-4 shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-filter"></i>
                </button>
                <ul class="dropdown-menu rounded-4 border-0 shadow p-0">
                    <li class="dropdown-item rounded-top-4 fs-5 fw-bold bg-body-secondary">Filtrar por Artista:</li>
                    <li><a class="dropdown-item rounded-bottom-4 bg-body-secondary" href="{{route('home')}}">Limpiar Filtro</a></li>
                    @foreach ($artistas as $artista)
                    <li><a class="dropdown-item rounded-4" href="{{ route('filtered',['user' => $artista->user]) }}">{{$artista->nombre}} {{$artista->apellido}}</a></li>
                    @endforeach
                </ul>
              </div>
        </div>
        @error('imageUnban')
        <div class="col-12">
          <div class="alert alert-success mt-4 rounded-4 mt-4 shadow border-2">
              {{ $message }}
          </div>
        </div>
        @enderror
        @error('motivo_ban')
        <div class="col-12">
          <div class="alert alert-info rounded-4 mt-4 shadow border-2" role="alert">
            {{ $message }}
          </div> 
        </div>
        @enderror
        @if(Auth::check() && Auth::user()->perfil_id == '2')
        @error('archivo')
        <div class="col-12">
          <div class="alert rounded-4 p-1 alert-danger mt-4 rounded-4 mt-4 shadow border-2">
              {{ $message }}
          </div>
        </div>
        @enderror
        @error('titulo')
        <div class="col-12">
          <div class="alert alert-danger mt-4 rounded-4 mt-4 shadow border-2">
              {{ $message }}
          </div>
        </div>
        @enderror
        @if(Session::has('message'))
        <div class="col-12">
          <div class="alert alert-success mt-3 rounded-4 mt-4 shadow border-2">
              {{Session::get('message')}}
          </div>
        </div>
        @endif
        <div class="d-grid gap-2">
            <button class="btn btn-secondary mt-3 rounded-4  shadow" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"><i class="fa-solid fa-file-arrow-up"></i> Subir Arte</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Arte</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      @auth
                          @php
                              $user = Auth::user();
                          @endphp
                      @endauth

                      <form action="{{route('image.upload', ['user'=> $user])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="title" class="form-label">Titulo de la publicacion</label>
                          <input type="text" class="form-control" id="title" name="titulo" >
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Sube aca tu arte</label>
                            <input class="form-control" type="file" id="formFile" name="archivo">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        @endif
        @foreach ($imagenes as $imagen)
        @if (Auth::check() && Auth::user()->perfil_id == '2')
          @if ($imagen->baneada == 0)
          <div class="col-auto mt-4 d-flex">
              <div class="card border-0 p-0 shadow rounded-4" style="width: 18rem;">
                  <img src="{{ asset('images/'. $imagen->archivo) }}" class="card-img-top rounded-top-4" alt="...">
                  <div class="card-body bg-body-secondary rounded-bottom-4">
                      <h5 class="card-title">{{$imagen->titulo}}</h5>
                      <p class="card-text">Autor: {{$imagen->cuenta->nombre}} {{$imagen->cuenta->apellido}}</p>
                      
                      
                  </div>
              </div>
          </div>
          @endif
        @elseif(Auth::check() && Auth::user()->perfil_id == '1')
        <div class="col-auto mt-4 d-flex">
            <div class="card border-0 p-0 shadow rounded-4" style="width: 18rem;">
                <img src="{{ asset('images/'. $imagen->archivo) }}" class="card-img-top rounded-top-4" alt="...">
                <div class="card-body bg-body-secondary rounded-bottom-4">
                    <h5 class="card-title">{{$imagen->titulo}}</h5>
                    <p class="card-text">Autor: {{$imagen->cuenta->nombre}} {{$imagen->cuenta->apellido}}</p>
                    @if($imagen->baneada == 1)
                    <p class="card-text">Motivo de baneo: {{$imagen->motivo_ban}}</p>
                    @endif
                    {{--Boton de modal para banear--}}
                    @if($imagen->baneada == 0)
                      @if(Auth::check() && Auth::user()->perfil_id == '1')
                      <button type="button" class="btn btn-danger rounded-4 shadow" data-bs-toggle="modal" data-bs-target="#banModal{{$imagen->id}}"><i class="fa-solid fa-ban"></i> Banear</button>

                      <div class="modal fade" id="banModal{{$imagen->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Motivo de baneo</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('image.ban', ['id' => $imagen->id])}}" method="POST">
                                @csrf
                                <input type="hidden" name="baneada" value="1">
                                <input type="text" name="motivo_ban" class="form-control border-2 rounded-4 mb-3">
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Banear</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    @else
                      @if(Auth::check() && Auth::user()->perfil_id == '1')
                      <form action="{{route('image.ban', ['id' => $imagen->id])}}" method="POST">
                          @csrf
                          <input type="hidden" name="baneada" value="0">
                          <button type="submit" class="btn btn-success shadow rounded-4"><i class="fa-solid fa-ban"></i> Desbanear</button>
                      </form>
                      @endif
                    @endif
                    
                    
                </div>
            </div>
        </div>

          



        @else
          @if ($imagen->baneada == 0)
          <div class="col-auto mt-4 d-flex">
              <div class="card border-0 p-0 shadow rounded-4" style="width: 18rem;">
                  <img src="{{ asset('images/'. $imagen->archivo) }}" class="card-img-top rounded-top-4" alt="...">
                  <div class="card-body bg-body-secondary rounded-bottom-4">
                      <h5 class="card-title">{{$imagen->titulo}}</h5>
                      <p class="card-text">Autor: {{$imagen->cuenta->nombre}} {{$imagen->cuenta->apellido}}</p>
                      
                      
                  </div>
              </div>
          </div>
          @endif

        @endif
        @endforeach
    </div>
</body>
</html>
@endsection


