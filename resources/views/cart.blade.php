<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{asset('assets/images/GetGear.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>GearShop</title>


    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/cart.css')}}">

</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand text-white" href="{{url("/obchod")}}">GearShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            </ul>
            @if(Auth::user())
                <form class="d-flex">
                    <a href="{{ url('/obchod/cart') }}" class="btn btn-outline-light">
                        <i class="bi-cart-fill me-1"></i>
                        Košík
                        <span class="badge bg-white text-dark ms-1 rounded-pill">{{ \App\Http\Controllers\KosikController::pocetVKosiku() }}</span>
                    </a>
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

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="product-details mr-2">
                <div class="d-flex flex-row align-items-center">
                    <a href="{{ route('products.index') }}">
                        <span class="ml-2">Pokračuj v nákupe</span>
                    </a>
                </div>
                <hr>
                <h6 class="mb-0">Tvoj košík</h6>
                <div class="d-flex justify-content-between"><span>Máš {{ \App\Http\Controllers\KosikController::pocetVKosiku() }} položiek v tvojom nákupnom košíku</span>
                </div>
                @foreach($kosik as $k)
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="{{ asset($k->itemy->cesta_obrazok) }}" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block">{{ $k->itemy->nazov }}</span><span class="spec">{{ $k->itemy->kategoria->nazov }}</span></div>
                        </div>
                        <span class="d-block" style="text-align: center;">{{ $k->quantity }}</span>

                        @php
                            $productPrice = \App\Http\Controllers\KosikController::calculateProductPrice($k->itemy);
                        @endphp
                        <div class="d-flex flex-row align-items-center"><span class="d-block ml-5 font-weight-bold">{{ $productPrice }} € </span> <i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-4">
            <div class="payment-info">
                <div class="d-flex justify-content-between align-items-center"><span>Detaily o karte</span></div><span class="type d-block mt-3 mb-1">Typ platobnej karty</span><label class="radio"> <input type="radio" name="card" value="payment" checked> <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png"/></span> </label>

                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png"/></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png"/></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png"/></span> </label>

                <form action="{{ route('pay') }}" method="post">
                    @csrf
                    <div><label>Meno na platobnej karte</label><input type="text" class="form-control credit-inputs" name="card_name" placeholder="MENO" required></div>
                    <div><label>Číslo karty</label><input type="text" class="form-control credit-inputs" name="card_number" placeholder="0000 0000 0000 0000" required></div>
                    <div class="row">
                        <div class="col-md-6"><label>Dátum ukončenia platnosti karty</label><input type="text" class="form-control credit-inputs" name="expiry_date" placeholder="12/24" required></div>
                        <div class="col-md-6"><label>CVV</label><input type="text" class="form-control credit-inputs" name="cvv" placeholder="342" required></div>
                    </div>
                    <button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="submit"><span>Zaplatiť</span></button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
