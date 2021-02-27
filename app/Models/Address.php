<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'CU')->where('section', 'Address');
    }
}
