<?php

namespace App\Http\Controllers;

use App\Category;
use App\Attribute;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        $active     = 'categories';

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

        $active = 'attributes';
        return view('eav.categories.show', compact([
                                                       'category',
                                                       'attributes',
                                                       'active',
                                                   ]));
    }


}
