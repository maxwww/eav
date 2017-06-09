<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name',
        'category_id',
        's_description',
        'description',
        'status',
        'count',
        'price',
        'params',
        ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
