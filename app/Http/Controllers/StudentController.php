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
    
              foreach ($csv as $record) {
                  $subjectValue = $record[4];
                  
                  $sectionValue = $record[0];
                  
                  $instructorValue = $record[25];
    
                   
                  if ($subjectValue !== 'Course Description' && trim($subjectValue) !== '') {
                      $subject[] = $subjectValue;
                  }
    
                  if (trim($sectionValue) !== '') {
                      $section[] = $sectionValue;
                  }
    
                  if ($instructorValue !== 'Instructor' && trim($instructorValue) !== '') {
                      $instructor[] = $instructorValue;
                  }
              }
    
              // dd($user);
    
              return view('student.studentirreg', compact('subject', 'section', 'instructor'));
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
          // Initialize arrays
          $subjects = [];
          $instructors = [];
          $sections = [];
          foreach ($sendSelected as $data) {
              // Use null coalescing operators to handle missing keys
              $subject = $data['subject'] ?? null;
              $instructor = $data['instructor'] ?? null;
              $section = $data['section'] ?? null;
              // Check if any of the required keys is missing for any item
              if ($subject === null || $instructor === null || $section === null) {
                  return response()->json(['error' => 'Missing data keys'], 400);
              }
              // Add data to respective arrays
              $subjects[] = $subject;
              $instructors[] = $instructor;
              $sections[] = $section;
          }
          // Save to the database
          foreach ($subjects as $index => $subject) {
              IrregStudentSub::create([
                  'irreg_students_id' => $userNameID,
                  'student_subject' => $subject,
                  'subject_instructor' => $instructors[$index],
                  'subject_section' => $sections[$index],
              ]);
          }
          // Return a response, e.g., success message
          return response()->json(['message' => 'Data stored successfully']);
      } else {
          return abort(404, 'Not authorized');
      }
  }
}
