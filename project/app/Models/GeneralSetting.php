<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'dashboard_logo', 'website_logo', 'website_icon', 'dashboard_icon', 'fb_id', 'fb_secret', 'fb_redirect', 'g_id', 'g_secret', 'g_redirect', 'captcha_secret', 'captcha_sitekey'
    ];
}
