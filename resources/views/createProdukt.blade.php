<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pridanie produktu</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formProduct.css')}}">
</head>
<body>
<div class="container">
    @can('create', $products)
    <h1>Pridanie produktu</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nazov">Názov:</label>
            <input type="text" name="nazov" id="nazov" required>
        </div>
        <div class="form-group">
            <label for="cena">Cena (€):</label>
            <input type="number" name="cena" id="cena" step=0.1 min="0" max="9999999" required>
        </div>
        <div class="form-group">
            <label for="kategoria_id">Kategória:</label>
            <select name="kategoria_id" id="kategoria_id" required>
                <option value="1">Procesory</option>
                <option value="2">Grafické karty</option>
                <option value="3">RAM</option>
                <option value="4">Disk</option>
            </select>
        </div>
        <div class="form-group">
            <label for="obrazok">Obrázok:</label>
            <input type="file" name="obrazok" id="obrazok" accept="image/*" required>
        </div>
        <button type="submit">Pridať produkt</button>
    </form>
    @endcan

    @cannot('create', $products)
        <h1>Pridanie produktu</h1>
        <p>Nemôžeš pridať produkt, pretože nie si admin!</p>
    @endcannot

    <span style="margin-right: 10px;"></span>
        <a href="{{ route('products.index') }}"><button type="button">Naspäť</button></a>
</div>
</body>
</html>
