<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Subject;

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
        $request = 'Csv';
        $data = $this->getDataFromCsv($request);

        $this->saveCourse($data['course']);
        $this->saveSubject($data['subject']);
    }

    public function getDataFromCsv($file){
        $data = [
            'course',
            'subject'
        ];
        return $data;
    }

    public function saveCourse($courseData){
        Course::create($courseData);
    }


    public function saveSubject($subjectData){

    }

}
