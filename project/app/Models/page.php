<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Form;

class page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'title', 'description', 'meta_keywords', 'meta_description', 'language_id', 'menu_id' 
    ];

    public function forms()
    {
        return $this->hasMany(Form::class, 'page_id', 'id');
    }
}
