<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'fee',
        'status',
    ];

    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class, 'enrollments')->withPivot('id', 'enrollment_date', 'status')->withTimestamps();
    }
}
