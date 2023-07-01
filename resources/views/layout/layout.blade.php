<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/79ebf5f069.js" crossorigin="anonymous"></script>
    <title>Interest</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 offset-1 pt-2">
                <nav class="navbar navbar-expand-lg rounded-3">
                    <div class="container-fluid">
                      <a class="nav-item" href="#"></a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a href="{{route('home')}}" class="navbar-brand active fw-bold fst-italic fs-4 text-danger" aria-current="page" href="#"><i class="fa-solid fa-italic text-danger"></i>nterest</a>
                          </li>
                          @if(Auth::check() == false)
                          <li class="nav-item">
                              <a class="nav-link" href="{{ url('/login') }}">Ingresar</a>
                          </li>
                          @endif
                          @if(Auth::check() && Auth::user()->perfil_id == '2')
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('session.show', ['user' => Auth::user()->user])}}"><i class="fa-solid fa-user"></i> Mi perfil</a>
                          </li>
                          @endif
                          @if(Auth::check() && Auth::user()->perfil_id == '1')
                          <li class="nav-item">
                            <a href="{{route('show.users')}}" class="nav-link"><i class="fa-solid fa-users"></i> Usuarios</a>
                          </li>
                          @endif




                          @if(Auth::check())
                          <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
                          </li>
                          @endif
                        </ul>
                      </div>
                    </div>
                  </nav>

            </div>
            <div class="col-10 offset-1 ">
              <div class="container-fluid mt-4"></div>
                  @yield('content')

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>