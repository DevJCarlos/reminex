<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTime extends Model
{
    use HasFactory;
    
    protected $fillable = ['exam_time', 'exam_day_ID', 'exam_period_ID'];
    protected $table = 'exam_times';
    
    public function examSub()
    {
        return $this->hasMany(ExamSubject::class, 'exam_time_ID', 'id');
    }

    public function examDay()
    {
        return $this->belongsTo(ExamPeriod::class, 'exam_day_ID', 'id');
    }

}
