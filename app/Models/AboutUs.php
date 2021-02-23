<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'AboutUs')->where('section', 'AboutUs');
    }
}
