<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'image',
    ];

    public function contents()
    {
        return $this->hasMany(LocaleContent::class, 'element_id')->where('page', 'events')->where('section', 'events');
    }
}
