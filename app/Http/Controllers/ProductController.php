<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Attribute;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as MRequest;
use Illuminate\Support\Facades\Input;
use Image;
use File;
use Illuminate\Database\QueryException;

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

        if ($product->params != "" && $product->params != "[]") {

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

        $all = Request::all();

        $params = '[]';
        if (isset($all['params'])) {
            $params = json_encode($all['params'], true);
        }


        $input = array_merge(Request::except('params', '_token'), compact('params'));

        $rules = [
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('message_failed', 'Not Saved.')->withInput()->withErrors($validator);
        }
        if (isset($input['img'])) {
            $image = Input::file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/' . $filename);


            Image::make($image->getRealPath())->resize(320, 360)->save($path);
            $input['img'] = $filename;
        }


        try {
            Product::create($input);
        } catch (QueryException $exception) {
            return redirect()->back()->with('message_failed', 'Not Saved -> Please write to admin.')->withInput();
        }

        return redirect('/admin/products')->with('message_success', 'Product Saved.');

    }

    public function destroy($id)
    {
        $product = Product::find((int)$id);

        if (!$product) {
            return redirect('');
        }

        if ($product->img != 'noimage.png') {
            File::delete('images/' . $product->img);
        }

        $product->delete();
        return redirect('/admin/products')->with('message_success', 'Product Deleted.');
    }

    public function edit($id)
    {
        $product = Product::find((int)$id);

        if (!$product) {
            return redirect('');
        }

        $params = json_decode($product->params, true);
        $attributes = Attribute::whereIn('id', json_decode($product->category->attributes, true))->get();
        $categories = Category::all();
        $active = 'products';
        return view('eav.products.edit', compact([
            'product',
            'attributes',
            'categories',
            'params',
            'active',
        ]));

    }

    public function update($id)
    {
        $product = Product::find((int)$id);

        if (!$product) {
            return redirect('');
        }

        $all = Request::all();

        $params = '[]';
        if (isset($all['params'])) {
            $params = json_encode($all['params'], true);
        }


        $input = array_merge(Request::except('params', '_token'), compact('params'));

        $rules = [
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('message_failed', 'Not Saved.')->withInput()->withErrors($validator);
        }
        if (isset($input['img'])) {
            $image = Input::file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/' . $filename);


            Image::make($image->getRealPath())->resize(320, 360)->save($path);
            if ($product->img != 'noimage.png') {
                File::delete('images/' . $product->img);
            }

            $input['img'] = $filename;
        }


        try {
            Product::where('id', (int)$id)
                ->update($input);
        } catch (QueryException $exception) {
            return redirect()->back()->with('message_failed', 'Not Saved -> Please write to admin.')->withInput();
        }

        return redirect()->back()->with('message_success', 'Product Saved.');
    }

    public function showSingleProduct($id)
    {
        $product = Product::find((int)$id);
        $product->load('category');

        if (!$product) {
            return redirect('');
        }

        $params = [];
        $attributes = [];

        if ($product->params != "" && $product->params != "[]") {

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

        $categories = Category::all();
        $current_category = $product->category->name;
        return view('eav.products.showSingle', compact([
            'product',
            'params',
            'attributes',
            'categories',
            'current_category',
        ]));
    }

    public function showFromCategory($id)
    {
        $category = Category::find((int)$id);
        $categories = Category::all();

        if (!$category) {
            return redirect('');
        }

        $products = Product::where('category_id', '=', $category->id)->paginate(6);
        $current_category = $category->name;
        return view('eav.productsFromCategory', compact([
            'categories',
            'current_category',
            'products'
        ]));
    }
}
