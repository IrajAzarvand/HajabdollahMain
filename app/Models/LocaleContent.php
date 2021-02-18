<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocaleContent extends Model
{
    protected $fillable = [
        'page',
        'section',
        'element_id',
        'locale',
        'element_title',
        'element_content',
    ];

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class)->where('section', 'slider');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function latestnews()
    {
        return $this->belongsTo(LatestNews::class);
    }

    public function footer()
    {
        return $this->belongsTo(Footer::class);
    }

    public function CH()
    {
        return $this->belongsTo(CertificatesAndHonors::class);
    }

    public function Galleries()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function SalesOffice()
    {
        return $this->belongsTo(SalesOffice::class);
    }

    public function CI()
    {
        return $this->belongsTo(CI::class);
    }
}
