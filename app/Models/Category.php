<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'keywords',
        'description',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFullPathAttribute()
    {
        $path = $this->title;
        $parent = $this->parent;

        while ($parent) {
            $path = $parent->title . ' > ' . $path;
            $parent = $parent->parent;
        }

        return $path;
    }
}