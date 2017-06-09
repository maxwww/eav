<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $active = 'products';
        $categories = Category::with('products')->get();

        return view(
            'eav.products.index',
            compact(
                [
                    'categories',
                    'active',
                ]
            )
        );
    }

    public function show($id)
    {

        $product = Product::find((int)$id);
        $product->load('category');

        if (!$product) {
            return redirect('');
        }

        $params = [];
        $attributes = [];


        if ($product->params != null) {
            $params = json_decode($product->params, true);
            $attributes_in_category = json_decode($product->category->attributes, true);
            foreach ($params as $key => $value) {
                if (!in_array($key, $attributes_in_category)) {
                    unset($params[$key]);
                }
            }

            if (count($params) > 0) {
                $attributes = Attribute::whereIn('id', array_keys($params))->get();
            }
        }

        $active = 'products';
        return view('eav.products.show', compact([
            'product',
            'params',
            'attributes',
            'active',
        ]));
    }
}
