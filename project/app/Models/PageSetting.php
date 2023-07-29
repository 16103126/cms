<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'subtitle', 'description', 'language_id', 'image', 'isDefault'
    ];

    public function language()
    {
        return $this->belongsTo(WebsiteLanguage::class)->withDefault();
    }
}
