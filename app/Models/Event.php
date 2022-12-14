<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'phone_client',
        'name_client',
        'user_id',
        'siteweb',
        'assignedBy',
        'assignementDate',
        'description',
        'status',
        'access',
        'priority',
        'color',
        'textColor',
        'note',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->hasOne(Task::class);
    }
    
}
