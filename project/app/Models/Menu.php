<?php

namespace App\Models;

use App\Models\Submenu;
use App\Models\WebsiteLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'url', 'order_id', 'isPrimary', 'position', 'isActive', 'language_id'
    ];

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'menu_id', 'id')->orderBy('order_id', 'asc');
    }

    public function language()
    {
        return $this->belongsTo(WebsiteLanguage::class)->withDefault();
    }
}
