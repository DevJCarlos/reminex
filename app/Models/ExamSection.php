<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSection extends Model
{
    use HasFactory;
    protected $fillable = ['exam_day_ID','exam_period_ID' ,'subject_name', 'section_name', 'class_num', 'instructor', 'class_count'];
    // protected $table = 'exam_sections';

    public function examDay()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }
    //user function
    public function userexamDay()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }

    
}
