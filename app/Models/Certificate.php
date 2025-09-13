<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_url',
        'certificate_number',
        'issued_date',
        'expiry_date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($certificate) {
            $certificate->certificate_number = 'CERT-' . strtoupper(uniqid());
            $certificate->issued_date = now();
            $certificate->expiry_date = now()->addYears(2);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}