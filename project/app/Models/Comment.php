<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'comment_id', 'reply'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function post()
    {
        return $this->belongsTo(Post::class)->withDefault();
    }

    public function replies()
    {
        $this->hasMany(Reply::class, 'comment_id', 'id');
    }
}
