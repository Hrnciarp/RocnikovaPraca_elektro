<?php

namespace App\Http\Controllers;

use App\Mail\PotvrdenieObjednavky;
use App\Models\Kosik;
use App\Models\Produkty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public static function getCartItems()
    {
        $user = Auth::user();


        $cartItems = Kosik::with('itemy')->where('user_id', $user->id)->get();

        return $cartItems;
    }

    public static function getCartItemsWithPrices()
    {
        $user = Auth::user();

        // Získa všetky položky v košíku pre prihláseného používateľa s cenami
        $cartItems = Kosik::with('itemy')->where('user_id', $user->id)->get();

        // Vytvoríme pole pre každú položku s jej cenou
        $cartItemsWithPrices = [];

        foreach ($cartItems as $item) {
            $price = self::calculateProductPrice($item->itemy); // Zavoláme funkciu calculateProductPrice
            $cartItemsWithPrices[] = [
                'item' => $item,
                'price' => $price,
            ];
        }

        return $cartItemsWithPrices;
    }

    public function pay(Request $request)
    {
        // Validácia údajov o platobnej karte
        $request->validate([
            'card_name' => 'required',
            'card_number' => 'required|size:16',
            'expiry_date' => 'required|size:5',
            'cvv' => 'required|size:3',
        ]);

        // Simulácia platby (v reálnom svete by ste použili platobnú bránu)
        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            // Odoslanie e-mailu
            Mail::to($request->user())->send(new PotvrdenieObjednavky());

            return redirect()->back()->with('success', 'Platba bola úspešná a potvrdzujúci e-mail bol odoslaný.');
        } else {
            return redirect()->back()->with('error', 'Platba nebola úspešná. Skontrolujte údaje o platobnej karte a skúste to znova.');
        }
    }



}
