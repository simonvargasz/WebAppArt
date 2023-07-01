@extends('layout/layout')
@section('content')


<div class="row">
    <div class="col-12">
        <h1 class="text-center">Artistas</h1>
        @if(Session::has('message'))
        <div class="alert alert-success mt-3 rounded-4 mt-4 shadow border-2">
            {{Session::get('message')}}
        </div>
        @endif
        @error('nombre')
        <div class="alert alert-danger mt-4 rounded-4 mt-4 shadow border-2">
            {{ $message }}
        </div>
        @enderror
        @error('apellido')
        <div class="alert alert-danger mt-4 rounded-4 mt-4 shadow border-2">
            {{ $message }}
        </div>
        @enderror
        <ul class="list-group">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-center flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5"></li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Usuario</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Nombre</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Apellido</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5"></li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Estado</li>

            </ul>
            @foreach ($cuentas as $cuenta)
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-center flex-fill me-auto text-start border-0 border-bottom rounded-0 col-2"><i class="fa-solid fa-circle-user fa-lg"></i></li>
                <li class="list-group-item flex-fill me-auto text-start border-0 border-bottom rounded-0 col-2">{{$cuenta->user}}</li>
                <li class="list-group-item flex-fill ms-auto border-0 border-bottom rounded-0 col-2">{{$cuenta->nombre}}</li>
                <li class="list-group-item flex-fill ms-auto border-0 border-bottom rounded-0 col-2">{{$cuenta->apellido}}</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-2">
                    <button class="btn btn-warning rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$cuenta->user}}"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                    <div class="modal fade" id="edit{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edicion de cuenta de usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('edit.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control rounded-4 border-2 mb-2" name="nombre" value="{{$cuenta->nombre}}">
                                <input type="text" class="form-control mb-2 rounded-4 border-2" name="apellido" value="{{$cuenta->apellido}}">
                                <button class="btn btn-success rounded-4 shadow" type="submit"><i class="fa-solid fa-check"></i> Actualizar datos</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-2">
                    @if($cuenta->eliminado == True)
                    <button class="btn btn-success rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#unbanConfirm{{$cuenta->user}}"><i class="fa-solid fa-check"></i> Desbanear</button>
                    
                    <div class="modal fade" id="unbanConfirm{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas desbanear esta cuenta?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('ban.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="eliminado" value="0">
                                <button class="btn btn-success rounded-4 shadow" type="submit"><i class="fa-solid fa-check"></i> Desbanear</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @else
                    <button class="btn btn-danger rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#banConfirm{{$cuenta->user}}"><i class="fa-solid fa-ban"></i> Banear</button>
                    <div class="modal fade" id="banConfirm{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas banear esta cuenta?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('ban.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="eliminado" value="1">
                                <button class="btn btn-danger rounded-4 shadow" type="submit"><i class="fa-solid fa-ban"></i> Banear</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                </li>
            </ul>
            @endforeach
        </ul>
    </div>
    <div class="col-12">
        <h1 class="text-center mt-4">Administradores</h1>
        @error('ban')
        <div class="alert alert-danger mt-4 rounded-4 mt-4 shadow border-2">
            {{ $message }}
        </div>
        @enderror
        <ul class="list-group">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-center flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5"></li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Usuario</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Nombre</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Apellido</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5"></li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-1 fw-bold fs-5">Estado</li>

            </ul>
            @foreach ($admins as $cuenta)
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item text-center flex-fill me-auto text-start border-0 border-bottom rounded-0 col-2"><i class="fa-solid fa-circle-user fa-lg"></i></li>
                <li class="list-group-item flex-fill me-auto text-start border-0 border-bottom rounded-0 col-2">{{$cuenta->user}}</li>
                <li class="list-group-item flex-fill ms-auto border-0 border-bottom rounded-0 col-2">{{$cuenta->nombre}}</li>
                <li class="list-group-item flex-fill ms-auto border-0 border-bottom rounded-0 col-2">{{$cuenta->apellido}}</li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-2">
                    <button class="btn btn-warning rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$cuenta->user}}"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                    <div class="modal fade" id="edit{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edicion de cuenta de usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('edit.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control rounded-4 border-2 mb-2" name="nombre" value="{{$cuenta->nombre}}">
                                <input type="text" class="form-control mb-2 rounded-4 border-2" name="apellido" value="{{$cuenta->apellido}}">
                                <button class="btn btn-success rounded-4 shadow" type="submit"><i class="fa-solid fa-check"></i> Actualizar datos</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item flex-fill border-0 border-bottom rounded-0 col-2">
                    @if($cuenta->eliminado == True)
                    <button class="btn btn-success rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#unbanConfirm{{$cuenta->user}}"><i class="fa-solid fa-check"></i> Desbanear</button>
                    
                    <div class="modal fade" id="unbanConfirm{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas desbanear esta cuenta?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('ban.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="eliminado" value="0">
                                <button class="btn btn-success rounded-4 shadow" type="submit"><i class="fa-solid fa-check"></i> Desbanear</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @else
                    <button class="btn btn-danger rounded-4 shadow btn-sm" data-bs-toggle="modal" data-bs-target="#banConfirm{{$cuenta->user}}"><i class="fa-solid fa-ban"></i> Banear</button>
                    <div class="modal fade" id="banConfirm{{$cuenta->user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas banear esta cuenta?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('ban.user', ['user' => $cuenta->user])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="eliminado" value="1">
                                <button class="btn btn-danger rounded-4 shadow" type="submit"><i class="fa-solid fa-ban"></i> Banear</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                </li>
            </ul>
            @endforeach
        </ul>
    </div>
</div>


@endsection