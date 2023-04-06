<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }
}
