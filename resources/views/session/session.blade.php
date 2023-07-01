@extends('layout/layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Informacion de la cuenta</div>

                <div class="card-body">
                    <p class="fs-5">Nombre: {{ $user->nombre }} {{ $user->apellido }}</p>
                    <p class="fs-5">Nombre de usuario: {{ $user->user }}</p>
                    <p class="fs-5">Tipo de cuenta: {{$user->perfil->nombre}}</p>
                    <p class="fs-5">Cantidad de fotos subidas: {{ $user->imagenes->count() }}</p>
                    <p class="fs-5">Fotos Baneadas: {{ $user->imagenes->where('baneada', 1)->count() }}</p>
                    <p class="fs-5">Fotos Aprobadas: {{ $user->imagenes->where('baneada', 0)->count() }}</p>
                    <hr class="border border-2 rounded-5 border-dark">
                    <p class="fs-5">Cambiar contraseña</p>

                    
                    <form action="{{route('change')}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="actualPassword" class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control" id="actualPassword" name="actualPassword">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        @error('newPassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('actualPassword')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if(Session::has('message'))
                        <div class="alert alert-success mt-3">
                            {{Session::get('message')}}
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Cambiar</button>

                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Libreria de fotos</div>
                <div class="card-body">
                    <div class="row">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @foreach($user->imagenes as $imagen)
                        <div class="col-3">
                            <div class="card">
                                <img src="{{asset('images/'.$imagen->archivo)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Titulo: {{$imagen->titulo}}</p>
                                    <p class="card-text">Estado: {{$imagen->baneada ? 'Baneada' : 'Aprobada'}}</p>
                                    @if($imagen->baneada)
                                    <p class="card-text">Motivo de ban: {{$imagen->motivo_ban}}</p>
                                    @endif
                                    <a href="" class="btn btn-primary rounded-4" data-bs-toggle="modal" data-bs-target="#update{{$imagen->id}}">Editar</a>
                                    
                                    <div class="modal fade" id="update{{$imagen->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar publicacion</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('title.change', $imagen->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Cambiar titulo de la publicacion</label>
                                                            <input class="form-control" id="title" name="titulo">
                                                        </div>
                                                        <button type="submit" class="btn btn-success rounded-4">Actualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger rounded-4" data-bs-toggle="modal" data-bs-target="#erase{{$imagen->id}}">
                                        Borrar publicacion
                                    </button>
                                    
                                    <div class="modal fade" id="erase{{$imagen->id}}" tabindex="-1" aria-labelledby="erase{{$imagen->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="erase">Deseas borrar esta publicacion?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('delete.image', ['id' => $imagen->id] )}}" method="post">
                                                        @csrf 
                                                        @method('DELETE') 
                                                        <button type="submit" class="btn btn-danger rounded-4">Confirmar Borrado</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
