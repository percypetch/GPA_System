<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['courses_code','courses_name','credit','descriptions','teacher_id'];

    function students() {
        return $this->belongsToMany(Student::class);
    }
}
