<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{
    use LogsActivity, HasApiTokens, HasFactory, Notifiable;
    
    protected static $logAttributes = ['*'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'color',
        'textColor',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
