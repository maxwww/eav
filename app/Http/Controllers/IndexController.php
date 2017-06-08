<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
//        $categories = Category::all();
//        $categories->load('products');
//
//        $products = Product::all();
//        $products->load('category');
//
//        $current_category = 2;

        $categories = [];
        $products = [];
        $current_category = 0;

        return view('eav.home', compact([
            'categories',
            'current_category',
            'products'
        ]));
    }
}
