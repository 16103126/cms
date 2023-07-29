<?php

use App\Models\GeneralSetting;

function generalSetting()
{
    $gs = GeneralSetting::findOrFail(1);
    
    return $gs;
}