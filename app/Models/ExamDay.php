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

    public function examRooms()
    {
    return $this->hasMany(ExamRoom::class, 'exam_day_ID','id');
    
    }

}
