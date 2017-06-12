<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addProductToCart($id)
    {

        $product = Product::find((int)$id);
        $html = '0';
        if ($product) {
            if (Session::has('cart.items.' . (int)$id)) {
                $countProducts = Session::get('cart.items.' . (int)$id . '.count');
                Session::put('cart.items.' . (int)$id . '.count', ++$countProducts);
            } else {
                Session::put('cart.items.' . (int)$id . '.count', 1);
                Session::put('cart.items.' . (int)$id . '.name', $product->name);
                Session::put('cart.items.' . (int)$id . '.price', $product->price);
                Session::put('cart.items.' . (int)$id . '.description', $product->s_description);
            }
            $allCount = Session::has('cart.count') ? Session::get('cart.count') : 0;
            $html = ++$allCount;
            Session::put('cart.count', $allCount);
            $total = Session::has('cart.total') ? Session::get('cart.total') : 0;
            $total += (float)$product->price;
            Session::put('cart.total', $total);
        }

        return response()->json([
            'status' => 'OK',
            'html' => $html,
        ]);
    }

    public function show()
    {
        if (Session::has('cart.items')) {
            $items = Session::get('cart.items');
        }


        $categories = Category::all();
        $current_category = '';
        return view('eav.cart', compact([
            'categories',
            'current_category',
            'items'
        ]));
    }
}
