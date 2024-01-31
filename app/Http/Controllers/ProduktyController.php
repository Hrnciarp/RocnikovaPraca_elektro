<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produkty;

class ProduktyController extends Controller
{
    //
    public function index()
    {
        $products = Produkty::all();

        return view('obchod', compact('products'));
    }

    public function create()
    {
        $products = new Produkty();
        return view('createProdukt' , compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nazov' => 'required',
            'cena' => 'required|min:0',
            'star_rating' => 'required|min:1|max:5',
            'obrazok' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'kategoria_id' => 'required|numeric|min:1|max:4',
        ]);
    
        $obrazok = $request->file('obrazok');
        $nazovSuboru = time().'.'.$obrazok->getClientOriginalExtension();
        $cesta = 'assets/images/'.$nazovSuboru;
    
        $obrazok->move(public_path('assets/images'), $nazovSuboru);
    
        $produkt = new Produkty([
            'nazov' => $request->get('nazov'),
            'cena' => $request->get('cena'),
            'star_rating' => $request->get('star_rating'),
            'cesta_obrazok' => $cesta,
            'kategoria_id' => $request->get('kategoria_id'),
        ]);
    
        $produkt->save();
    
        return redirect('/obchod')->with('success', 'Produkt bol uložený!');
    }

    public function edit($id)
    {

        $products = Produkty::findOrFail($id);
        return view('editProdukt', compact('products'));
    }

    public function destroy($id)
    {

        $produkt = Produkty::find($id);

        if(file_exists(public_path($produkt->cesta_obrazok))){
            unlink(public_path($produkt->cesta_obrazok));
        }
    
        $produkt->delete();
    
        return redirect('/obchod')->with('success', 'Produkt bol úspešne odstránený!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nazov' => 'required',
            'cena' => 'required|min:0',
            'star_rating' => 'required|min:1|max:5',
            'obrazok' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'kategoria_id' => 'required|numeric|min:1|max:4',
        ]);
    
        $produkt = Produkty::find($id);
    
        $produkt->nazov = $request->get('nazov');
        $produkt->cena = $request->get('cena');
        $produkt->star_rating = $request->get('star_rating');
        $produkt->kategoria_id = $request->get('kategoria_id');
    
        if($request->file('obrazok')){
            $obrazok = $request->file('obrazok');
            $nazovSuboru = time().'.'.$obrazok->getClientOriginalExtension();
            $cesta = 'assets/images/'.$nazovSuboru;
    
            $obrazok->move(public_path('assets/images'), $nazovSuboru);
    
            $produkt->cesta_obrazok = $cesta;
        }
    
        $produkt->save();
    
        return redirect('/obchod')->with('success', 'Produkt bol úspěšne aktualizovaný!');
    }
    


}
