<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name'];

    public function examSections()
    {
        return $this->hasMany(ExamTime::class, 'exam_subject_ID', 'id');
    }



}
