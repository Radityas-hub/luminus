<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'instructor_id',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'duration',
        'video_count',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')->withTimestamps();
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function videoParts()
    {
        return $this->hasMany(VideoPart::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    
}