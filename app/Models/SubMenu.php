<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $fillable = [
        'main_menu',
        'SubMenu',
        'Url',
        'Icon',
    ];

    public function main_menu()
    {
        return $this->belongsTo(MainMenu::class);
    }
}
