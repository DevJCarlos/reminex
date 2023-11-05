<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function storeRequest(Request $request)
    {
        $request->validate([
            'stud_name' => 'required',
            'department' => 'required',
            'request_type' => 'required',
            'subject' => 'required',
            'instructor' => 'required',
            'reason' => 'required',
            'time_available' => 'required',
            'requirement' => 'required|mimes:pdf,doc,docx|max:3000',
        ]);
        
        $stud_name = $request->stud_name;
        $department = $request->department;
        $request_type = $request->request_type;
        $subject = $request->subject;
        $instructor = $request->instructor;
        $reason = $request->reason;
        $time_available = $request->time_available;
        
        // Handle file uploads
        $requirement = $request->file('requirement');
        $requirementName = time() . '_' . $requirement->getClientOriginalName();
    
        $requirement->storeAs('uploads', $requirementName);
    
        // Save file information to the database
        $newRequest = RequestModel::create([

            'stud_name' => $stud_name,
            'department' => $department,
            'request_type' => $request_type,
            'subject' => $subject,
            'instructor' => $instructor,
            'reason' => $reason,
            'time_available' => $time_available,
            'file_name' => $requirement->getClientOriginalName(),
            'file_path' => $requirementName,
        ]);

        if (!$newRequest) {
            return redirect(route('student.createrequest'))->with('error', 'Application Failed! Try Again!');
        }
    
        return redirect(route('student.createrequest'))->with('success', 'Successfully Requested!');
    }

    public function requests(Request $request)
    {
        return view('requests');
    }
}
