<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produkty;

class ProduktyController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategoria_id = $request->get('kategoria_id');

        $sort_by = $request->get('sort_by');
        $order = $request->get('order');

        $request->session()->put('kategoria_id', $kategoria_id);

        $products = Produkty::query();

        if ($search) {
            $products = $products->where('nazov', 'like', "%{$search}%");
        }

        if ($kategoria_id) {
            $products = $products->where('kategoria_id', $kategoria_id);
        }

        if ($sort_by && $order) {
            $products = $products->orderBy($sort_by, $order);
        }

        $products = $products->paginate(8)->appends(request()->query());

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
            'star_rating' => $this->generateStar(),
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
            'obrazok' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'kategoria_id' => 'required|numeric|min:1|max:4',
        ]);
    
        $produkt = Produkty::find($id);
    
        $produkt->nazov = $request->get('nazov');
        $produkt->cena = $request->get('cena');
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
    
    private function generateStar()  {
        $pocet_hviezd = mt_rand(3,5);
        return $pocet_hviezd;
    }


}
