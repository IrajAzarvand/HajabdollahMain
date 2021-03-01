<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'ptype_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'products')->where('section', 'category')->where('element_title', 'category');
    }

    public function ptype()
    {
        return $this->belongsTo(PType::class);
    }
}
