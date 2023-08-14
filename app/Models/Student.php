<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ModelClass;
use App\Models\Subject;
use App\Models\Course;

class Student extends Model
{
    use HasFactory;

    public function subject(){
        return $this->belongsToMany(Subject::class, 'model_classes');
    }

    public function course(){
        return $this->hasOne(Course::class, 'id');
    }

    public function section(){
        return $this->belongsToMany(Section::class,'model_classes');
    }
}
