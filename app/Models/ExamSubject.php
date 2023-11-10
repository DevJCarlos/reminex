<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name','exam_period_ID'];

    public function examSections()
    {
        return $this->hasMany(ExamTime::class, 'exam_subject_ID', 'id');
    }

    //all exam usage
    public function examSectionss()
    {
    return $this->hasMany(ExamSection::class, 'exam_subject_ID', 'id');
    }


    public function examDaytoSub()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }


    public function examTime()
    {
    return $this->belongsTo(ExamTime::class, 'exam_time_ID', 'id');
    }
   




}
