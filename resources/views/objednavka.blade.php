<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Potvrdenie objednávky</title>
</head>
<body>
<h1>Potvrdenie objednávky</h1>

<p>Ďakujeme za vašu objednávku č. {{ $cisloObjednavky }}.</p>

<h2>Detaily objednávky:</h2>
<ul>
    @foreach($cartItemsWithPrices as $item)
        <li>{{ $item['item']->quantity }}x {{ $item['item']->itemy->nazov }} - {{ $item['price'] }} €</li>
    @endforeach
</ul>

<p>Suma: {{ $totalPrice }} €</p>

<p>Pri ďalších otázkach nás neváhajte kontaktovať.</p>

<p>S pozdravom,<br>
    Tím GearShop</p>
</body>
</html>


