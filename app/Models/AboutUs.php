<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'paragraph_1',
        'paragraph_2',
        'image',
        'video_url',
        'team_title',
        'team_description',
        'team_members',
    ];
    public $translatable = [
        'title',
        'paragraph_1',
        'paragraph_2',
        'team_title',
        'team_description'
    ];

    protected $casts = [
        'team_members' => 'array',
    ];
}
