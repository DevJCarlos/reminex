<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestCourse;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        $requestcourses = RequestCourse::all();

        return view('users.index', compact('users','requestcourses'));
    }

    public function indexFaculty()
    {
        $users = User::paginate();
        $requestcourses = RequestCourse::all();

        return view('users.indexfaculty', compact('users','requestcourses'));
    }

    public function indexStudent()
    {
        $users = User::paginate();
        $requestcourses = RequestCourse::all();

        return view('users.indexstudent', compact('users','requestcourses'));
    }
}

