<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RequestModel;

class TeacherController extends Controller
{
    public function index(){
            $user = User::find(1);
            return view('faculty.index', compact('user'));
    }
    
    public function show(){
        return view('faculty.show');
    }

    public function manageRequest(){
        $request = Request::all(); // Add this line to get the request data
        return view('faculty.managerequest', compact('request'));
    }
    
    
    public function requestArchive(){
        return view('faculty.requestarchive');
    }

    // public function changeprofilePic(){
    //     return view('faculty.changeprofilepic');
    // }

    public function changePass(){
        return view('faculty.changepass');
    }

    public function aboutUs(){
        return view('faculty.aboutus');
    }

}
