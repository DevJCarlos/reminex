<?php

namespace App\Http\Controllers;
use App\Models\Rooms;

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
    
}

    

