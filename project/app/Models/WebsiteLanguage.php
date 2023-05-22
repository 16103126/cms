<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'language', 'file', 'isDefault'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'language_id', 'id');
    }
}
