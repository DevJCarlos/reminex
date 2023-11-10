<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    use HasFactory;
    protected $fillable = ['exam_day_ID', 'room_name', 'exam_period_ID'];
    
    public function examRoom()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }
    public function examTime()
    {
        return $this->hasMany(ExamTime::class, 'exam_time_ID', 'id');
    }

}
