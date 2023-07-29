<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class Form extends Model
{
    use HasFactory;

    protected $fillable =[
        'title', 'input', 'textarea', 'image', 'file', 'select', 'checkbox', 'radio', 'page_id', 'isActive'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class)->withDefault();
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'form_id', 'id');
    }
 
}
