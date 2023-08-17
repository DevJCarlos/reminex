<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ModelClass;
use App\Models\Student;

class Subject extends Model
{
    use HasFactory;

    //fillable by classlistbysec in HomeController
    protected $fillable = ['code', 'name'];

    public function student(){
        return $this->belongsToMany(Student::class, 'model_classes');
    }
    
    public function course(){
        return $this->belongsToMany(Course::class, 'model_classes');
    }

}
