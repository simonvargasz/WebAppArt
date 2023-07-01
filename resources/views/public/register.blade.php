<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/79ebf5f069.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body style="background: linear-gradient(27deg, rgba(3,0,0,1) 0%, rgba(144,0,55,1) 100%);">
    <div class="container vh-100">
        <div class="row vh-100">
            <div class="col-6 offset-3 align-self-center">
                <div class="card w-100 rounded-5 pb-5 shadow-lg" style="width: 18rem;">
                    <div class="card-body mt-2 mb-5 p-0">
                      <div class="card-header bg-white border border-0 rounded-5 pt-2 text-end mb-5">
                        <a href="{{route('public')}}"><i class="fa-solid fa-xmark fa-2xl text-dark me-2 mt-3"></i></a>
                      </div>
                      <h5 class="card-title text-center fs-1">Registrate</h5>
                      <div class="container">
                          <div class="row">
                              <div class="col-8 offset-2">
                                  <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">@error('nombre')<i class="fa-solid fa-circle-exclamation text-danger"></i></span>@enderror Nombre @error('nombre')<i class="fa-solid fa-arrow-left text-danger"></i> <span class="text-danger">{{ $message }}</span>@enderror </label>
                                      <input type="text" class="form-control border-3 rounded-4" id="nombre" name="nombre">
                                    </div>
                                    <div class="mb-3">
                                      <label for="apellido" class="form-label">@error('apellido')<i class="fa-solid fa-circle-exclamation text-danger"></i></span>@enderror Apellido @error('apellido')<i class="fa-solid fa-arrow-left text-danger"></i> <span class="text-danger">{{ $message }}</span>@enderror </label>
                                      <input type="text" class="form-control border-3 rounded-4" id="apellido" name="apellido">
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">@error('user')<i class="fa-solid fa-circle-exclamation text-danger"></i></span>@enderror Nombre de usuario @error('user')<i class="fa-solid fa-arrow-left text-danger"></i> <span class="text-danger">{{ $message }}</span>@enderror </label>
                                      <input type="text" class="form-control border-3 rounded-4" id="exampleInputEmail1" aria-describedby="emailHelp" name="user">
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">@error('password')<i class="fa-solid fa-circle-exclamation text-danger"></i></span>@enderror Contraseña @error('password')<i class="fa-solid fa-arrow-left text-danger"></i> <span class="text-danger">{{ $message }}</span>@enderror </label>
                                      <input type="password" class="form-control border-3 rounded-4" id="exampleInputPassword1" name="password">
                                    </div>
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                      <button type="submit" class="btn btn-primary rounded-pill fw-bold" type="button">Registrarse</button>
                                    </div>
                                    <div class="text-center">
                                      <a href="{{route('user.login')}}" class="text-decoration-none">Ya tienes cuenta? Inicia sesion</a>
                                    </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>