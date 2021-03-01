<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cat_id',
        'images',
    ];

    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'products')->where('section', 'products');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function catalogues()
    {
        return $this->belongsTo(ProductCatalog::class, 'product_id');
    }

    public function ptype()
    {
        return $this->belongsTo(PType::class);
    }
}
