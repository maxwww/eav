<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
        $categories = Category::all();

        $current_category = 'PC2';

        return view('eav.home', compact([
            'categories',
            'current_category',
            'products'
        ]));
    }
}
