<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        $current_category = '';
//        Session::flush();

//        dd(Session::all());

        $products = Product::inRandomOrder()->take(6)->get();

        return view('eav.home', compact([
            'categories',
            'current_category',
            'products'
        ]));
    }
}
