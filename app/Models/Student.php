<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'profile_image',
    ];

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }

    public function courses(){
        return $this->belongsTo(Course::class, 'enrollments')->withPivot('id','enrollment_date', 'status')->withTimestamps();
    }
}

