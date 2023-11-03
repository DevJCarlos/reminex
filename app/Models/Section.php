<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function subject(){
        return $this->belongsTo(Subject::class,'model_classes');
    }

    public function student(){
        return $this->belongsToMany(Student::class,'model_classes');
    }
    

}
