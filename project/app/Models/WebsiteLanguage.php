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

    public function posts()
    {
        return $this->hasMany(Post::class, 'language_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'language_id', 'id');
    }

    public function page_settings()
    {
        return $this->hasMany(PageSetting::class, 'language_id', 'id');
    }
}
