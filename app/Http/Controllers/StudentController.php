<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewSched;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    public function index(){
        $user = User::find(1);
        return view('student.index', compact('user'));
    }

    public function show(){
        return view('student.show');
    }

    public function createRequest(){
        return view('student.createrequest');
    }

    public function viewRequest(){
        return view('student.viewrequest');
    }

    public function newSched(){
        return view('student.newsched');
    }
    //econif ni
    public function showsubject(){
        return view('show.subject');
    }


    // public function changeprofilePic(){
    //     return view('student.changeprofilepic');
    // }

    public function changePass(){
        return view('student.changepass');
    }

    public function aboutUs(){
        return view('student.aboutus');
    }

    public function changePassword(Request $request)
    {
        // Validate the form data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Find the authenticated user
        $user = auth()->user();

        // Check if the old password matches
        if (Hash::check($request->old_password, $user->password)) {
            // Update the user's password with the new one
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('student.changepass')->with('success', 'Password changed successfully!');
        } else {
            return redirect()->route('student.changepass')->with('error', 'Incorrect old password. Please try again.');
        }
    }
}
