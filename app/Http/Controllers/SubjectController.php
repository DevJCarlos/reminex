<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function fetchSubjects(Request $request)
    {
        $fetch = $request->query('fetch');
        $subjects = [];

        if (method_exists($this, 'fetch' . ucfirst($fetch) . 'Subjects')) {
            $methodName = 'fetch' . ucfirst($fetch) . 'Subjects';
            $subjects = $this->$methodName();
        }

        // Log the fetched subjects
        Log::info('Fetched subjects:', ['subjects' => $subjects]);

        return response()->json($subjects);
    }

    private function fetchPrelimSubjects()
    {
        return Subject::select('program', 'year', 'serial', 'subject')
            ->where('prelim', 'Written')
            ->get()
            ->toArray();
    }

    private function fetchMidtermSubjects()
    {
        return Subject::select('program', 'year', 'serial', 'subject')
            ->where('midterm', 'Written')
            ->get()
            ->toArray();
    }

    private function fetchPreFinalsSubjects()
    {
        return Subject::select('program', 'year', 'serial', 'subject')
            ->where('prefinal', 'Written')
            ->get()
            ->toArray();
    }

    private function fetchFinalsSubjects()
    {
        return Subject::select('program', 'year', 'serial', 'subject')
            ->where('final', 'Written')
            ->get()
            ->toArray();
    }
}
