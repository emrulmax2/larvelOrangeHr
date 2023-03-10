<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description','user_id'
    ];
    public function getCreatedAtAttribute($value)
    {
        return date("d/m/Y H:i",strtotime($value));
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
