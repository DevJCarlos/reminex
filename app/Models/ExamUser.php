<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExamUser extends Model
{
    use HasFactory;
  
    protected $fillable = ['exam_day_ID', 'day', 'period_name'];

    public function examDay()
    {
        return $this->belongsTo(ExamDay::class, 'exam_day_ID', 'id');
    }
}
