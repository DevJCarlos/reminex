<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDay extends Model
{
    use HasFactory;
    
    protected $fillable = ['date', 'day_num'];

    public function examPeriod()
    {
        return $this->belongsTo(ExamPeriod::class, 'exam_period_ID','id');
    }

    public function examRoom()
    {
        return $this->hasMany(ExamRoom::class, 'exam_day_ID','id');
    }

    public function examTime()
    {
    return $this->hasMany(ExamTime::class, 'exam_day_ID','id');
    
    }

    public function examSub()
    {
    return $this->hasMany(ExamSubject::class, 'exam_day_ID','id');
    
    }

    public function examSec()
    {
    return $this->hasMany(ExamSection::class, 'exam_day_ID','id');
    
    }
    //for users
    public function examSubject()
    {
        return $this->belongsTo(ExamSubject::class, 'exam_subject_ID', 'id');
    }

    
    public function examUsers()
    {
        return $this->hasMany(ExamUser::class, 'exam_day_ID', 'id');
    }
}
