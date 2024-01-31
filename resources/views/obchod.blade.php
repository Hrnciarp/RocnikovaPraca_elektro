<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{asset('assets/images/GetGear.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>GearShop</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/styles.css')}}">

</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand text-white" href="{{url("/obchod")}}">GearShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link text-white" href="#!">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            @if(Auth::user())
                <form class="d-flex">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Košík
                        <span class="badge bg-white text-dark ms-1 rounded-pill">0</span>
                    </button>
                </form>
                <div class="dropdown">
                    <button class="btn dropdown-toggle btn-outline-light" type="text" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-right-to-bracket"></i> {{ Auth::user()->name }}
                        @foreach(Auth::user()->role as $role)
                            [{{ $role->name_of_role }}]
                        @endforeach
                        <span class="text-sm text-gray-500">
                        </span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profil') }}
                            </a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Odhlásiť sa
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <button class="btn dropdown-toggle btn-outline-light" type="text" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-right-to-bracket"></i> Login/Register
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('login')}}">Prihlásiť sa</a></li>
                        <li><a class="dropdown-item" href="{{url('register')}}">Zaregistrovať sa</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
<!-- Header-->
<header class="py-5 bg-image-full" style="background-image: url('{{asset('assets/images/background_obchod.jpg')}}')">
    <div class="text-center my-5">
        <h1 class="text-white fs-3 fw-bolder">GearShop</h1>
    </div>
</header>


@if(Auth::user() && Auth::user()->hasRole('admin'))
        <section class="py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="d-grid mb-2">
                        <a href="{{ url('/obchod/create') }}" class="text-black">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase bg-blue-400" type="button">
                                Pridať produkt
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
@endif

<!-- Section-->
<section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset($product->cesta_obrazok) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->nazov }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @for ($i = 0; $i < $product->star_rating; $i++)
                                            <div class="bi-star-fill"></div>
                                        @endfor
                                    </div>
                                    <!-- Product price-->
                                    {{ $product->cena }} €
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                            @can('update', $product)
                                <a class="float-right btn btn-outline-primary ml-2" href="#"> <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Peter Hrnčiar 2024</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
