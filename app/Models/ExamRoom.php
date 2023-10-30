<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    use HasFactory;
    protected $fillable = ['exam_time_ID','exam_day_ID', 'room_name'];
    
    public function examTime()
    {
        return $this->belongsTo(ExamTime::class, 'exam_time_ID', 'id');
    }

    public function examDay()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }

}
