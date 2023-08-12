<?php

namespace App\Http\Controllers;
use App\Models\Rooms;

use App\Models\upload_csv_matrix;
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
        return view('exams.index');
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

            $subject = new upload_csv_matrix();
            $subject->name = $fileName; 
            $subject->url = Storage::url('uploads/' . $fileName);
            $subject->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    //fetch csv data
    public function fetchSubjects(Request $request)
    {
        $selectedPeriod = $request->input('period');

        if ($selectedPeriod === 'Prelim') {
            
            $files = Storage::files('public/uploads');
            $latestFile = end($files); 
    
           
            $csvPath = storage_path('app/' . $latestFile);
    
           
            
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            
            
            foreach ($csv as $record) {
                
                if ($record['PRELIM'] === 'Written') {
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
        if ($selectedPeriod === 'Midterm') {
            
            $files = Storage::files('public/uploads');
            $latestFile = end($files); 
    
           
            $csvPath = storage_path('app/' . $latestFile);
    
            
            
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            
            
            foreach ($csv as $record) {
                
                if ($record['MIDTERM'] === 'Written') {
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
        if ($selectedPeriod === 'Pre-Final') {
            
            $files = Storage::files('public/uploads');
            $latestFile = end($files); 
    
            
            $csvPath = storage_path('app/' . $latestFile);
    
            
            
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            
            
            foreach ($csv as $record) { 
                
                if ($record['PRE-FINAL'] === 'Written') {
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
        if ($selectedPeriod === 'Finals') {
            
            $files = Storage::files('public/uploads');
            $latestFile = end($files); 
    
            
            $csvPath = storage_path('app/' . $latestFile);
    
            
            
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            
            
            foreach ($csv as $record) {
                
                if ($record['FINAL'] === 'Written') {
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

        
        return response()->json([]);
    }
}

    

