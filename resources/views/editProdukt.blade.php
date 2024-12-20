<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Úprava produktu</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formProduct.css')}}">
</head>
<body>
<div class="container">
    @can('update', $products)
    <h1>Úprava produktu</h1>
    <form action="{{ route('products.update', $products->produkt_id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        <div class="form-group">
            <label for="nazov">Názov:</label>
            <input type="text" name="nazov" id="nazov" value="{{ $products->nazov }}" required>
        </div>
        <div class="form-group">
            <label for="cena">Cena (€):</label>
            <input type="number" name="cena" id="cena" step=0.1 min="0" max="9999999" value="{{ $products->cena }}" required>
        </div>
        <div class="form-group">
            <label for="kategoria_id">Kategória:</label>
            <select name="kategoria_id" id="kategoria_id" required>
                <option value="1" @if($products->kategoria_id == 1) selected @endif>Procesory</option>
                <option value="2" @if($products->kategoria_id == 2) selected @endif>Grafické karty</option>
                <option value="3" @if($products->kategoria_id == 3) selected @endif>RAM</option>
                <option value="4" @if($products->kategoria_id == 4) selected @endif>Disk</option>
            </select>
        </div>
        <div class="form-group">
            <label for="obrazok">Obrázok:</label>
            <input type="file" name="obrazok" id="obrazok" accept="image/*">
        </div>
        <button type="submit">Upraviť produkt</button>
    </form>
    @endcan

    @cannot('update', $products)
        <h1>Úprava produktu</h1>
        <p>Nemôžeš upraviť produkt, pretože nie si admin!</p>
    @endcannot

    <span style="margin-right: 10px;"></span>
        <a href="{{ route('products.index') }}"><button type="button">Naspäť</button></a>
</div>
</body>
</html>

