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
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
        <title>GearShop - Potvrdenie objednávky</title>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/styles.css')}}">
    
    </head>
<body>

<header class="py-5 bg-image-full" style="background-image: url('{{asset('assets/images/background_obchod.jpg')}}')">
    <div class="text-center my-5">
        <h1 class="text-white fs-3 fw-bolder">GearShop</h1>
    </div>
</header>

<h1>Potvrdenie objednávky</h1>

<p>Ďakujeme za vašu objednávku č. {{ $cisloObjednavky }}.</p>

<h2>Detaily objednávky:</h2>
<ul>
    @foreach($cartItemsWithPrices as $item)
        <li>{{ $item['item']->quantity }}x {{ $item['item']->itemy->nazov }} - {{ $item['price'] }} €</li>
    @endforeach
</ul>

<p><span>Suma:</span> {{ $totalPrice }} €</p>

<p>Pri ďalších otázkach nás neváhajte kontaktovať.</p>

<p>S pozdravom,<br>
    Tím GearShop</p>
    <img src="{{ asset('assets/images/GetGear.png') }}">
</body>
</html>


