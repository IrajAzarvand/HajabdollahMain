<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PType extends Model
{
    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'products')->where('section', 'ptype')->where('element_title', 'ptype');
    }


    public function categories()
    {
        return $this->hasMany(Category::class, 'ptype_id');
    }
}
