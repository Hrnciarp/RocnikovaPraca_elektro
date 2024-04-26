<?php

namespace App\Http\Controllers;

use App\Models\Kosik;
use App\Models\Produkty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosikController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $kosik = Kosik::where('user_id', $user->id)->get();

        return view('cart', compact('kosik'));
    }


    public function addToCart(Request $request, Produkty $product)
    {
        $user = Auth::user();


        $cartItem = Kosik::where('user_id', $user->id)->where('produkt_id', $product->produkt_id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
        } else {
            // Otherwise, create a new cart item
            $cartItem = new Kosik();
            $cartItem->user_id = $user->id;
            $cartItem->produkt_id = $product->produkt_id;
            $cartItem->quantity = 1;
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Produkt bol úspešne pridaný do košíka!');
    }

    public static function pocetVKosiku()
    {
        $user = Auth::user();


        $pocet = Kosik::where('user_id', $user->id)->sum('quantity');

        return $pocet;
    }

    public static function calculateProductPrice(Produkty $product)
    {
        $user = Auth::user();

        $kosikItem = Kosik::where('user_id', $user->id)->where('produkt_id', $product->produkt_id)->first();

        if ($kosikItem) {
            $productPrice = $kosikItem->itemy->cena * $kosikItem->quantity;

            return $productPrice;
        } else {
            return 0;
        }
    }

    public static function calculateTotalPrice()
    {
        $user = Auth::user();

        $kosik = Kosik::where('user_id', $user->id)->get();

        $totalPrice = 0;

        foreach ($kosik as $item) {
            $totalPrice += $item->itemy->cena * $item->quantity;
        }

        return $totalPrice;
    }




}
