<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCourse extends Model
{
    use HasFactory;

    protected $table = 'request_course';

    protected $fillable = [
        'course_name',
    ];
}
