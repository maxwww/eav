<?php

namespace App\Http\Controllers;

use App\Attribute;
//use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::paginate(10);
        $active = 'attributes';

        return view('eav.attributes.index', compact([
            'attributes',
            'active',
        ]));
    }

    public function create()
    {
        $active = 'attributes';
        return view('eav.attributes.create', compact(['active']));
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
            'slug' => 'unique:attributes,slug',
            'name' => 'required',
            'type' => 'required|in:text,checkbox,select,radio,textarea',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('attributes/create')->withErrors($validator)->withInput()->with('message_failed', 'Not Saved.');
        }

        Attribute::create($input);

        return redirect('attributes')->with('message_success', 'Attribute Saved.');
    }

    public function show($id)
    {

        $attribute = Attribute::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }

        $options = !($attribute->type == 'text' || $attribute->type == 'textarea');

        if ($options) {
            $options = json_decode($attribute->options, true);
        }

        $active = 'attributes';
        return view('eav.attributes.show', compact([
            'attribute',
            'options',
            'active',
        ]));
    }

    public function destroy($id)
    {
        $attribute = Attribute::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }
        $attribute->delete();
        return redirect('attributes')->with('message_success', 'Attribute Deleted.');
    }

    public function edit($id)
    {

        $attribute = Attribute::find((int)$id);

        if (!$attribute) {
            return redirect('');
        }
        $options = !($attribute->type == 'text' || $attribute->type == 'textarea');

        if ($options) {
            $options = json_decode($attribute->options, true);
        }

        $active = 'attributes';
        return view('eav.attributes.edit', compact([
            'attribute',
            'options',
            'active',
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
            Attribute::where('id', (int)$id)
                ->update($input);
        } catch (QueryException $exception) {
            return redirect()->back()->with('message_failed', 'Not Saved -> Slug is duplicated.')->withInput();
        }


        return redirect()->back()->with('message_success', 'Attribute Saved.');
    }
}
