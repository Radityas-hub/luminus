<?php
// App\Models\Forum.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relasi ke Thread
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}