<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Attribute;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as MRequest;
use Illuminate\Support\Facades\Input;

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

    public function create()
    {
        $active = 'products';
        $categories = Category::all();
        return view('eav.products.create', compact([
            'active',
            'categories',
        ]));
    }

    public function store()
    {

        $file = Request::file('img');
        $all = Request::all();

        dd(json_encode($all['params'], true));

        $input = array_merge(Request::except('params', '_token'), compact('attributes'));

        $rules = [
            'name' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('message_failed', 'Not Saved.')->withInput()->withErrors($validator);
        }

        try {
            Category::where('id', (int)$id)
                ->update($input);
        } catch (QueryException $exception) {
            return redirect()->back()->with('message_failed', 'Not Saved -> Please write to admin.')->withInput();
        }


        return redirect()->back()->with('message_success', 'Category Saved.');


        dd(25);
    }
}
