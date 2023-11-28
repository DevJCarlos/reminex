<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\RequestCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;





class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

    public function createAdmin(Request $data)
    {
        // Check if any of the fields are null
        if ($data->name && $data->department && $data->username && $data->email && $data->role && $data->password) {
            // All fields are not null, create the user
            $user = User::create([
                'name' => $data->name,
                'department' => $data->department,
                'username' => $data->username,
                'email' => $data->email,
                'role' => $data->role,
                'password' => Hash::make($data->password),
            ]);
    
            $user->assignRole($data->role);
            $user->save();
    
            return redirect()->route('users.index')->with('success', 'Successfully Registered!');
        } else {
            // Some fields are null, return an error message
            return redirect()->back()->with('error', 'Please fill all the information.');
        }
    }

    public function createFaculty(Request $data)
    {
        // Check if any of the fields are null
        if ($data->name && $data->department && $data->username && $data->email && $data->role && $data->password) {
            // All fields are not null, create the user
            $user = User::create([
                'name' => $data->name,
                'department' => $data->department,
                'username' => $data->username,
                'email' => $data->email,
                'role' => $data->role,
                'password' => Hash::make($data->password),
            ]);
    
            $user->assignRole($data->role);
            $user->save();
    
            return redirect()->route('users.indexfaculty')->with('success', 'Successfully Registered!');
        } else {
            // Some fields are null, return an error message
            return redirect()->back()->with('error', 'Please fill all the information.');
        }
    }

    public function createStudent(Request $data)
    {
        // Check if any of the fields are null
        if ($data->name && $data->department && $data->username && $data->course && $data->email && $data->role && $data->password && $data->student_section && $data->student_status) {
            // All fields are not null, create the user
            $user = User::create([
                'name' => $data->name,
                'department' => $data->department,
                'username' => $data->username,
                'course' => $data->course,
                'student_sec' => $data->student_section,
                'student_status' => $data->student_status,
                'email' => $data->email,
                'role' => $data->role,
                'password' => Hash::make($data->password),
            ]);
            // dd($data->student_section);
    
            $user->assignRole($data->role);
            $user->save();
    
            return redirect()->route('users.indexstudent')->with('success', 'Successfully Registered!');
        } else {
            // Some fields are null, return an error message
            return redirect()->back()->with('error', 'Please fill all the information.');
        }
    }

    //update admin
    public function updateAdmin(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            // Update user data
            $user->username = $request->username;
            $user->name = $request->name;
            $user->department = $request->department;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            // Save changes
            $user->save();

            return redirect()->route('users.index')->with('success', 'Admin updated successfully!');
        } else {
            return redirect()->route('users.index')->with('error', 'User not found!');
        }
    }

    //update student
    public function updateStudent(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            // Update user data
            $user->username = $request->username;
            $user->name = $request->name;
            $user->department = $request->department;
            $user->course = $request->course;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            // Save changes
            $user->save();

            return redirect()->route('users.indexstudent')->with('success', 'Student updated successfully!');
        } else {
            return redirect()->route('users.indexstudent')->with('error', 'User not found!');
        }
    }

    //update faculty
    public function updateFaculty(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            // Update user data
            $user->username = $request->username;
            $user->name = $request->name;
            $user->department = $request->department;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            // Save changes
            $user->save();

            return redirect()->route('users.indexfaculty')->with('success', 'Faculty updated successfully!');
        } else {
            return redirect()->route('users.indexfaculty')->with('error', 'User not found!');
        }
    }

    public function getUserData($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
    // public function destroy(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return redirect()->route('users.index')->with('error', 'User not found!');
    //     }

    //     $user->delete();

    //     return redirect()->route('users.index')->with('success', 'User successfully deleted!');
    // }


}
