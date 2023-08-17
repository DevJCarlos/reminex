<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // dri ka sugod
    public function saveData(Request $request){
        $request->validate([
            'section' => 'required|mimes:csv,txt',
        ]);
    
        if ($request->hasFile('section')) {
            $file = $request->file('section');
            
            $originalFileName = $file->getClientOriginalName();
            $explodeName = explode(' ', $originalFileName);
            $fileName = time() . '-' . implode('-', $explodeName);
            
            $file->storeAs('listsection', $fileName, 'public');
    
            $data = [
                'name' => $fileName,
                'url' => Storage::url('listsection/' . $fileName),
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            // SAVE TO DATABASE
            DB::table('upload_csv_listsections')->insert($data);
    
            // get data from csv
            $dataFromCsv = $this->getDataFromCsv('listsection/' . $fileName);
    
            $uniqueSubjects = collect($dataFromCsv['subject'])->unique('code');
            foreach ($uniqueSubjects as $subjectData) {
                $this->saveSubject($subjectData);
            }

            $uniqueCourses = collect($dataFromCsv['course'])->unique('name');
            foreach ($uniqueCourses as $courseData) {
                $this->saveCourse($courseData);
            }

            $uniqueSections = collect($dataFromCsv['section'])->unique('name');
            foreach ($uniqueSections as $sectionData) {
                $this->saveSection($sectionData);
            }
    
            // waw
            $uniqueTeachers = collect($dataFromCsv['teacher'])->unique('name');
            foreach ($uniqueTeachers as $teacherData) {
                $teacherName = $teacherData['name'];
            
                
                if (strpos($teacherName, "\n") === false) {
                    $this->saveTeacher($teacherData);
                }
            }
            
        }
        
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    

    
    public function getDataFromCsv(){

    $files = Storage::files('public/listsection');
    $latestFile = end($files);    
    $csvPath = storage_path('app/' . $latestFile);
    $csv = Reader::createFromPath($csvPath, 'r');
    

    

    $subjectData = [];
    $courseData = [];
    $sectionData = [];
    $teacherData = [];

    foreach ($csv as $record) {

        if (in_array($record['0'], ['Course Code', 'Class Section', 'Course Description'])){
            continue;
        }

        $coursecode = $record[0]; // First column sa csv
        $coursedesc = $record[3]; // Fourth column sa csv
        $sectioncourse = $record[2]; // third column
        $teachername = mb_convert_encoding($record[24], 'UTF-8', 'auto');

        $subjectData[] = [
            'code' => $coursecode,
            'name' => $coursedesc,
        ];

        $courseData[] = [
            'name' => $sectioncourse,
        ];

        $sectionData[] = [
            'name' => $sectioncourse,
        ];
        $teacherData[] = [
            'name' => $teachername,
        ];
        

    }

    return [
        'subject' => $subjectData,
        'course' => $courseData,
        'section' => $sectionData,
        'teacher' => $teacherData,
    ];
    
}
    
    public function saveCourse($courseData){
        Course::create($courseData);
    }
    public function saveSubject($subjectData){
        Subject::create($subjectData); 
    }
    public function saveSection($sectionData){
        Section::create($sectionData); 
    }
    public function saveTeacher($teacherData){
        Teacher::create($teacherData); 
    }
    
}
