<?php

namespace App\Http\Controllers;

use App\Category;
use App\Attribute;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        $active = 'categories';

        return view(
            'eav.categories.index',
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

        $category = Category::find((int)$id);

        if (!$category) {
            return redirect('');
        }

        $attributes = [];

        if ($category->attributes != null) {
            $attributes = json_decode($category->attributes, true);

            if (count($attributes) > 0) {
                $attributes = Attribute::whereIn('id', $attributes)->get();
            }
        }

        $active = 'categories';
        return view('eav.categories.show', compact([
            'category',
            'attributes',
            'active',
        ]));
    }

    public function create()
    {
        $active = 'categories';
        $attributes = Attribute::all();
        return view('eav.categories.create', compact([
            'active',
            'attributes',
        ]));
    }

    public function store()
    {
        $options = Request::get('options');
        $attributes = [];
        if ($options != null) {
            foreach ($options as $key => $value) {
                $attributes[] = $key;
            }
        }
        $attributes = json_encode($attributes, true);

        $input = array_merge(Request::except('options', '_token'), compact('attributes'));

        $rules = [
            'name' => 'required',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/admin/categories/create')->withErrors($validator)->withInput()->with('message_failed', 'Not Saved.');
        }

        Category::create($input);

        return redirect('/admin/categories')->with('message_success', 'Category Saved.');
    }

    public function destroy($id)
    {
        $category = Category::find((int)$id);

        if (!$category) {
            return redirect('');
        }
        $category->delete();
        return redirect('/admin/categories')->with('message_success', 'Category Deleted.');
    }

    public function edit($id)
    {
        $category = Category::find((int)$id);

        if (!$category) {
            return redirect('');
        }

        $category->attributes = json_decode($category->attributes, true);
        $attributes = Attribute::all();
        $active = 'categories';
        return view('eav.categories.edit', compact([
            'category',
            'attributes',
            'active',
        ]));

    }

    public function update($id)
    {
        $options = Request::get('options');
        $attributes = [];
        if ($options != null) {
            foreach ($options as $key => $value) {
                $attributes[] = $key;
            }
        }
        $attributes = json_encode($attributes, true);
        $input = array_merge(Request::except('options', '_token'), compact('attributes'));

        $rules = [
            'name' => 'required',
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
    }

    public function getAttributes($id)
    {
        $category = Category::find((int)$id);

        $html = 'Not found!';
        $status = 'failed';
        if ($category) {
            $attributes = Attribute::whereIn('id', json_decode($category->attributes, true))->get();
            $html = view('eav.categories.attributes', compact(['attributes']))->render();
            $status = "ok";
        }


        return response()->json([
            'status' => $status,
            'html' => $html
        ]);
    }
}
