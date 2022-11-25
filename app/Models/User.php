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
    use HasApiTokens, HasFactory, Notifiable;
    
    protected static $logAttributes = ['*'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'color',
        'textColor',
        'avatar',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function events(){
        return $this->hasMany(Event::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
