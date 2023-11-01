<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    protected $fillable = ['subject_name', 'section_name', 'class_num', 'instructor', 'class_count'];
}
