<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelClass;

use App\Models\Student;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function subject(){
        return $this->belongsToMany(Subject::class, 'model_classes');
    }

    public function student(){
        return $this->belongsToMany(Student::class,'model_classes');
    }

}
