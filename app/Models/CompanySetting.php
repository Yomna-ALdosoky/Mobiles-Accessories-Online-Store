<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanySetting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'contact_section_desc',
        'address',
        'primary_phone',
        'secondary_phone',
        'support_email',
        'career_email',
        'working_hours_weekday',
        'working_hours_weekend',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'whatsapp_number',
    ];

    public $translatable = [
        'contact_section_desc',
        'address',
        'working_hours_weekday',
        'working_hours_weekend'
    ];
}
