<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Request;
use Mail;
use Illuminate\Support\Facades\Validator;
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
        $items = [];
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

    public function removeFromCart($id)
    {
        $allCount = 0;
        if ($id == 'all') {
            Session::forget('cart');
        } elseif (Session::has('cart.items.' . (int)$id)) {

            $count = Session::get('cart.items.' . (int)$id . '.count');
            
            $price = Session::get('cart.items.' . (int)$id . '.price');

            if ($count > 1) {
                $count--;
                Session::put('cart.items.' . (int)$id . '.count', $count);
            } else {
                Session::forget('cart.items.' . (int)$id);
            }

            $total = Session::get('cart.total') - $price;

            Session::put('cart.total', $total);

            $allCount = Session::get('cart.count');
            $allCount--;
            Session::put('cart.count', $allCount);

        }

        $items = [];
        if (Session::has('cart.items')) {
            $items = Session::get('cart.items');
        }

        $html = view('eav.liveCart', compact(['items']))->render();

        return response()->json([
            'status' => 'OK',
            'html' => $html,
            'allCount' => $allCount,
        ]);
    }

    public function checkout()
    {

        $categories = Category::all();
        $current_category = '';
        return view('eav.checkout', compact([
            'categories',
            'current_category',
        ]));
    }

    public function submit()
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $input = Request::except('_token');
        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('message_failed', 'Not Submitted!')->withInput()->withErrors($validator);
        }

        $items = [];
        if (Session::has('cart.items')) {
            $items = Session::get('cart.items');
        }

        Mail::send('eav.send', ['input' => $input, 'items' => $items], function ($message)
        {

            $message->from('admin@site.com', 'Site Bot');
            $message->to('admin@site.com');
            $message->subject('New Order');

        });

        Session::forget('cart');
        return redirect('/')->with('message_success', 'Submitted!');
    }
}
