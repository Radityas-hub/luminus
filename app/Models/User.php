<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'otp',
        'otp_expires_at',
        'profile_picture_url',
        'nationality',
        'city', 
        'phone',
        'occupation', 
        'personal_goal',
        'status',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function videoParts()
    {
        return $this->belongsToMany(VideoPart::class, 'user_video_parts', 'user_id', 'video_part_id')->withTimestamps();
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    public function votes()
    {
    return $this->hasMany(ThreadVote::class);
    }
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}