<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPeriod extends Model
{
    use HasFactory;
    public function examDays()
    {
        return $this->hasMany(ExamDay::class, 'exam_period_ID', 'id');
    }
}
