<?php

namespace App\Http\Controllers;

use App\Param;
//use Illuminate\Http\Request;
use App\Category;
use Request;
use Validator;
use Illuminate\Database\QueryException;

class AttributesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $current_category = '';


        $attributes = Param::paginate(10);

        return view('eav.attributes.index', compact([
            'attributes',
            'categories',
            'current_category'
        ]));
    }

    public function create()
    {
        $categories = Category::all();
        $current_category = '';


        return view('eav.attributes.create', compact([
            'attributes',
            'categories',
            'current_category'
        ]));
    }

    public function store()
    {
        $options = [];

        $type = Request::get('type');
        if (!($type == 'text' || $type == 'textara')) {
            foreach (Request::get('options', []) as $option) {
                if (!$option['key'] and !$option['value']) continue;
                $options[$option['key']] = $option['value'];
            }
        }


        $options = json_encode($options, true);
        $input = array_merge(Request::except('options', '_token'), compact('options'));

        $rules = [
            'slug' => 'unique:params,slug',
            'name' => 'required',
            'type' => 'required|in:text,checkbox,select,radio,textarea',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('attributes/create')->withErrors($validator)->withInput()->with('message_failed', 'Not Saved.');
        }

        Param::create($input);

        return redirect('attributes')->with('message_success', 'Attribute Saved.');
    }

    public function show($id)
    {
        $categories = Category::all();
        $current_category = '';

        $attribute = Param::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }

        $options = !($attribute->type == 'text' || $attribute->type == 'textarea');

        if ($options) {
            $options = json_decode($attribute->options, true);
        }
        return view('eav.attributes.show', compact([
            'attribute',
            'categories',
            'current_category',
            'options',
        ]));
    }

    public function destroy($id)
    {
        $attribute = Param::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }
        $attribute->delete();
        return redirect('attributes')->with('message_success', 'Attribute Deleted.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $current_category = '';

        $attribute = Param::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }
        $options = !($attribute->type == 'text' || $attribute->type == 'textarea');

        if ($options) {
            $options = json_decode($attribute->options, true);
        }

        return view('eav.attributes.edit', compact([
            'attribute',
            'categories',
            'current_category',
            'options',
        ]));

    }

    public function update($id)
    {
        $options = [];

        $type = Request::get('type');
        if (!($type == 'text' || $type == 'textara')) {
            foreach (Request::get('options', []) as $option) {
                if (!$option['key'] and !$option['value']) continue;
                $options[$option['key']] = $option['value'];
            }
        }


        $options = json_encode($options, true);
        $input = array_merge(Request::except('options', '_token'), compact('options'));


        $rules = [
            'slug' => 'required',
            'name' => 'required',
            'type' => 'required|in:text,checkbox,select,radio,textarea',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with('message_failed', 'Not Saved.')->withInput()->withErrors($validator);
        }

        try {
            Param::where('id', (int)$id)
                ->update($input);
        } catch (QueryException $exception) {
            return redirect()->back()->with('message_failed', 'Not Saved -> Slug is duplicated.')->withInput();
        }


        return redirect()->back()->with('message_success', 'Attribute Saved.');
    }
}
