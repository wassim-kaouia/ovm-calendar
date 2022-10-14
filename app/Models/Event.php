<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rdv',
        'description',
        'status',
        'access',
        'priority',
        'note'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->hasOne(Task::class);
    }

}
