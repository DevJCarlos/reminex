<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrregStudentSub extends Model
{
    use HasFactory;
    protected $fillable = ['irreg_students_id', 'student_subject', 'subject_instructor', 'subject_section', 'code'];
}
