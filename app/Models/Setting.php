<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'hotline',
        'footer_phone',
        'work_hours_weekdays',
        'work_hours_saturday',
        'footer_email',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'skype_url',
        'google_url',
        'app_store_url',
        'play_store_url'
    ];
}
