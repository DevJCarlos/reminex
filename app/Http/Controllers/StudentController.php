<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewSched;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use App\Models\IrregStudentSub;
use Illuminate\Support\Facades\Auth;

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


    // public function changeprofilePic(){
    //     return view('student.changeprofilepic');
    // }

    public function changePass(){
        return view('student.changepass');
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

    public function aboutUs(){
        return view('student.aboutus');
    }
    public function showsubject(){
        $user = Auth::user();
    
          if ($user && $user->hasRole('student')) {
            $directoryPath = storage_path('app/public/listsection');
    
            $csvFiles = glob($directoryPath . '/*.csv', GLOB_NOSORT);
            usort($csvFiles, function ($a, $b) {
                return filemtime($b) - filemtime($a);
            });
    
            $latestCsvFile = reset($csvFiles);
    
            if ($latestCsvFile) {
                $csv = Reader::createFromPath($latestCsvFile, 'r');
    
              $subject = [];
              $section = [];
              $instructor = [];
              $code = [];
    
              foreach ($csv as $record) {
                  $subjectValue = $record[4];
                  
                  $sectionValue = $record[0];
                  
                  $instructorValue = $record[25];
                  $codeValue = $record[9];
    
                   
                  if ($subjectValue !== 'Course Description' && trim($subjectValue) !== '') {
                      $subject[] = $subjectValue;
                  }
    
                  if (trim($sectionValue) !== '') {
                      $section[] = $sectionValue;
                  }
    
                  if ($instructorValue !== 'Instructor' && trim($instructorValue) !== '') {
                      $instructor[] = $instructorValue;
                  }

                  if ($codeValue !== 'Career' && trim($codeValue) !== '' && $codeValue !== 'Class No') {
                    $code[] = $codeValue;
                }
              }
    
            //   dd($code);
    
              return view('student.studentirreg', compact('subject', 'section', 'instructor','code'));
          } else {
               
              return abort(404, 'No CSV file found');
          }
      }
  }
  public function storeSelectedData(Request $request)
  {
      $user = Auth::user();
      if ($user && $user->hasRole('student')) {
          $sendSelected = $request->input('selectedData');
          $userNameID = $user->id;
          
          $subjects = [];
          $instructors = [];
          $sections = [];
          $codes = [];
          foreach ($sendSelected as $data) {
              
              $subject = $data['subject'] ?? null;
              $instructor = $data['instructor'] ?? null;
              $section = $data['section'] ?? null;
              $code = $data['code'] ?? null;
              
              if ($subject === null || $instructor === null || $section === null || $code === null ) {
                  return response()->json(['error' => 'Missing data keys'], 400);
              }
              
              $subjects[] = $subject;
              $instructors[] = $instructor;
              $sections[] = $section;
              $codes[] = $code;
          }
          
          foreach ($subjects as $index => $subject) {
              IrregStudentSub::create([
                  'irreg_students_id' => $userNameID,
                  'student_subject' => $subject,
                  'subject_instructor' => $instructors[$index],
                  'subject_section' => $sections[$index],
                  'code' => $codes[$index],
              ]);
          }
          
          return response()->json(['message' => 'Data stored successfully']);
      } else {
          return abort(404, 'Not authorized');
      }
  }
}
