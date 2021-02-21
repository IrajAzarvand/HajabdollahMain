<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class MainNav extends Model
{
    protected $fillable = [
        'content_fa',
        'content_en',
        'content_ru',
        'content_ar',
        'url',
        'route_name',
    ];


    public function sub_navs()
    {
        return $this->hasMany(SubNav::class);
    }
}