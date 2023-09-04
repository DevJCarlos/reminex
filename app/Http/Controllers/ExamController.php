<?php

namespace App\Http\Controllers;
use App\Models\Rooms;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

use League\Csv\Statement;


class ExamController extends Controller

{
    //fetch rooms
    public function create(){
        $rooms = $this->getRooms();
        return view('exams.create', compact('rooms'));
    }
    
    public function index(){
        return view('exam.index');
    }


    public function getRooms(){
        $rooms = Rooms::all();
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

        return redirect()->back()->with('success', 'File uploaded successfully.');
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
    




  
public function fetchAdditionalInfo(Request $request)
{
    $selectedSubjectNames = $request->json()->all();

    // Initialize an array to store the additional information
    $additionalInfo = [];

    // Get the latest CSV file in the "listsection" directory
    $files = Storage::files('public/listsection');
    $latestFile = end($files);

    // Construct the full path to the latest CSV file
    $csvPath = storage_path('app/' . $latestFile);

    // Check if the CSV file exists
    if (file_exists($csvPath)) {
        // Create a CSV reader
        $csv = Reader::createFromPath($csvPath, 'r');

        // Read and store the header row
        $header = $csv->fetchOne();

        // Iterate through the CSV records
        foreach ($csv->getRecords() as $record) {
            // Get the subject name from the 5th column (index 4)
            $subjectName = trim($record[4]);

            // Check if the subject name is in the selected subjects array
            if (in_array($subjectName, $selectedSubjectNames)) {
                // Extract the required information
                $section = trim($record[0]);    // 1st row as section
                $classNumber = trim($record[9]); // 9th row as CLASS #
                $instructor = trim($record[25]); // 25th row as Instructor
                $numOfStudents = trim($record[28]); // 28th row as # of students

                // Store the information in the additionalInfo array
                $additionalInfo[$subjectName] = [
                    'Section' => $section,
                    'CLASS #' => $classNumber,
                    'Instructor' => $instructor,
                    '# of students' => $numOfStudents,
                ];
            }
        }
    }

    return response()->json($additionalInfo);
}
    
}

    

