<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTime extends Model
{
    use HasFactory;
    
    protected $fillable = ['exam_time', 'exam_day_ID'];
    protected $table = 'exam_times';
    

    public function examDay()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }
}
