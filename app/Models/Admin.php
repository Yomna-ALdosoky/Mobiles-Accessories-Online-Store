<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone_number',
        'super_admin',
        'status',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
