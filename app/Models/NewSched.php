<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewSched extends Model
{
    use HasFactory;

    protected $table = 'new_schedule';

    protected $fillable = [
        'stud_name2',
        'request_type2',
        'subject2',
        'instructor2',
        'exam_day',
        'exam_time',
        'room',
    ];
}
