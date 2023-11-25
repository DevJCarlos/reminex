<?php

namespace App\Http\Controllers;

use App\Models\Room;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;




class ExamController extends Controller

{
    //fetch rooms
    public function create(){
        $rooms = $this->getRooms();
        return view('exams.create', compact('rooms'));
    }
    
    // public function index(){

    //     return view('exams.index');
    // }


    public function getRooms(){
        $rooms = Room::all();
        return $rooms;
    }

    //upload csv
    public function uploadCSV(Request $request)
    {
        $request->validate([
            'matrix' => 'required|mimes:csv,txt',
        ]);

        if ($request->hasFile('matrix')) {
            $file = $request->file('matrix');
            
            $originalFileName = $file->getClientOriginalName();
            $explodeName = explode(' ', $originalFileName);
            $fileName = time() . '-' . implode('-', $explodeName);
            
            $file->storeAs('uploads', $fileName, 'public');
    
            $data = [
                'name' => $fileName,
                'url' => Storage::url('uploads/' . $fileName),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            
            DB::table('upload_csv_matrices')->insert($data);
        }

        return redirect()->back()->with('message', 'File Upload Successfully');
    }

    //fetch csv data
    public function fetchSubjects(Request $request)
    {
        $selectedPeriod = $request->input('period');
    
        $files = Storage::files('public/uploads');
        $latestFile = end($files); 
        $csvPath = storage_path('app/' . $latestFile);
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0);
    
        $subjects = [];
    
        switch ($selectedPeriod) {
            case 'Prelim':
                $columnKey = 'PRELIM';
                break;
            case 'Midterm':
                $columnKey = 'MIDTERM';
                break;
            case 'Pre-Final':
                $columnKey = 'PRE-FINAL';
                break;
            case 'Finals':
                $columnKey = 'FINAL';
                break;
            default:
                $columnKey = '';
                break;
        }
    
        foreach ($csv as $record) {
            if ($columnKey !== '' && $record[$columnKey] === 'Written') {
                $subject = [
                    'course_title' => $record['COURSE TITLE'],
                    'program' => $record['PROGRAM'],
                    'year' => $record['YEAR'],
                    'serial' => $record['SERIAL'],
                ];
                $subjects[] = $subject;
            }
        }
    
        return response()->json($subjects);
    } 
    
    public function fetchAdditionalInfo(Request $request){
        $selectedSubjectNames = $request->json()->all();
    
        
        $additionalInfo = [];
    
       
        $files = Storage::files('public/listsection');
        $latestFile = end($files);
    
        
        $csvPath = storage_path('app/' . $latestFile);
    
        
        if (file_exists($csvPath)) {
            
            $csv = Reader::createFromPath($csvPath, 'r');
    
            
            $header = $csv->fetchOne();
    
            
            foreach ($csv->getRecords() as $record) {
                
                $subjectName = trim($record[4]);
    
                
                if (in_array($subjectName, $selectedSubjectNames)) {
                    
                    $section = trim($record[0]);    
                    $classNumber = trim($record[9]); 
                    $instructor = trim($record[25]); 
                    $numOfStudents = trim($record[28]); 
    
                    
                    if (isset($additionalInfo[$subjectName])) {
                        
                        $additionalInfo[$subjectName] .=
                            "<br><strong>--------------------------------------</strong>". 
                            "<br><strong>Section:</strong> $section" .
                            "<br><strong>Class #:</strong> $classNumber" .
                            "<br><strong>Instructor:</strong> $instructor" .
                            "<br><strong># of students:</strong> $numOfStudents";
                    } else {
                        // If it doesn't exist, create a new entry with labels
                        $additionalInfo[$subjectName] = 
                        "<br><strong>--------------------------------------</strong>".
                            "<br><strong>Section:</strong> $section" .
                            "<br><strong>Class #:</strong> $classNumber" .
                            "<br><strong>Instructor:</strong> $instructor" .
                            "<br><strong># of students:</strong> $numOfStudents";
                    }
                }
            }
        }
    
        return response()->json($additionalInfo);
    }
    
    public function displaygentable(Request $request) {
        $selectedSubjectNames1 = $request->json()->all();
    
        $sectionsArray = [];
        $classNumberArray = [];
        $instructorArray = [];
        $numOfStudentsArray = [];
    
        $files = Storage::files('public/listsection');
        $latestFile = end($files);
    
        $csvPath = storage_path('app/' . $latestFile);
    
        if (file_exists($csvPath)) {
            $csv = Reader::createFromPath($csvPath, 'r');
            $header = $csv->fetchOne();
    
            foreach ($csv->getRecords() as $record) {
                $subjectName = trim($record[4]);
    
                if (in_array($subjectName, $selectedSubjectNames1)) {
                    $section = trim($record[0]);
                    $classNumber = trim($record[9]);
                    $instructor = trim($record[25]);
                    $numOfStudents = trim($record[28]);
    
                    // Store the extracted information in separate arrays organized by subject name
                    if (!isset($sectionsArray[$subjectName])) {
                        $sectionsArray[$subjectName] = [];
                    }
                    $sectionsArray[$subjectName][] = $section;
    
                    if (!isset($classNumberArray[$subjectName])) {
                        $classNumberArray[$subjectName] = [];
                    }
                    $classNumberArray[$subjectName][] = $classNumber;
    
                    if (!isset($instructorArray[$subjectName])) {
                        $instructorArray[$subjectName] = [];
                    }
                    $instructorArray[$subjectName][] = $instructor;
    
                    if (!isset($numOfStudentsArray[$subjectName])) {
                        $numOfStudentsArray[$subjectName] = [];
                    }
                    $numOfStudentsArray[$subjectName][] = $numOfStudents;
                }
            }
        }
        $result = [
            
            'sections' => $sectionsArray,
            'classNumbers' => $classNumberArray,
            'instructors' => $instructorArray,
            'numOfStudents' => $numOfStudentsArray,
        ];
        return response()->json($result);

    }
    
}    
    

