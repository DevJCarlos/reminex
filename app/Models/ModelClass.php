<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'subject_id',
        'section_id',
        'course_id',
        'teacher_id',
    ];

    public function classes(){
        return $this->belongsTomany();
    }

    public function subject(){
        return $this->belongsTomany('');
    }

}
