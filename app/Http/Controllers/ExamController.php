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
            $fileNameWithoutSpaces = str_replace(' ', '_', $originalFileName);
            
            
            $fileName = time() . '_' . $fileNameWithoutSpaces;
            
            $file->storeAs('uploads', $fileName, 'public');

            $subject = new Subject();
            $subject->name = $fileNameWithoutSpaces; 
            $subject->url = Storage::url('uploads/' . $fileName);
            $subject->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    
}
