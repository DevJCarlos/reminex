<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name'];

    public function examSecs()
    {
        return $this->belongsTo(ExamTime::class, 'exam_time_ID', 'id');
    }


}
