<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ExamController extends Controller

{
    //
    public function create(){
        $rooms = $this->getRooms();
        return view('exams.create', compact('rooms'));
    }


    public function getRooms(){
        $rooms = Rooms::all();
        return $rooms;
    }
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

            $subject = new Subject();
            $subject->name = $fileName; 
            $subject->url = Storage::url('uploads/' . $fileName);
            $subject->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    //fetch
    public function fetchSubjects(Request $request)
    {
        $selectedPeriod = $request->input('period');

        // If the selected period is "prelim", fetch data from the CSV
        if ($selectedPeriod === 'prelim') {
            // Change the path and filename according to your CSV file location
            $csvPath = storage_path('app/public/uploads/1691279788-SPE-Matrix-(4).csv'); // Replace with your file path
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0); // Assumes the first row is the header
            dd($csv->fetchAll());

            $subjects = [];
            
            // Loop through CSV rows and filter data based on condition
            foreach ($csv as $record) {
                dd($record);
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

        // Handle other cases or return an empty array if not prelim
        return response()->json([]);
    }
}

    

