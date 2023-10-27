<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    use HasFactory;
    protected $fillable = ['exam_time_ID', 'room_name'];
    
    // public function examDay()
    // {
    //     return $this->belongsTo(ExamDay::class, 'exam_time_ID', 'id');
    // }
}
