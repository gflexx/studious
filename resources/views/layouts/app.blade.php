<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Studious Studio</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-dark">
    <div class="my-4 container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-6 col-lg-4">
                <form class="d-flex" role="search" action="{{ route('search_studio') }}">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search Studio" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('studios_all') }}">Studios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tracks_all') }}">
                            Tracks
                        </a>
                    </li>
                    @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">
                                Cart
                                @if(session('num_cart_items'))
                                    <span class="text-white num_cart_items">( {{ session('num_cart_items') }} )</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    @if (auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container page">

        @yield('content')

    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
