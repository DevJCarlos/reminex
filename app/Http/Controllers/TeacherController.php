<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RequestModel;
use Illuminate\Support\Facades\Hash;

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
        return view('faculty.changepass2');
    }

    public function changePassword2(Request $request)
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
            return redirect()->route('faculty.changepass2')->with('success', 'Password changed successfully!');
        } else {
            return redirect()->route('faculty.changepass2')->with('error', 'Incorrect old password. Please try again.');
        }
    }

    public function aboutUs(){
        return view('faculty.aboutus');
    }

}
