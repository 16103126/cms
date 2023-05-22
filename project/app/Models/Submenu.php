<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'order_id', 'menu_id', 'url', 'isPrimary', 'isActive', 'language_id'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class)->withDefualt();
    }
}
