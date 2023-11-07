<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\NewSched;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{

    //creating student request
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

    
    public function createRequest()
    {
        $userrecords = User::all();
        return view('student.createrequest', ['userrecords' => $userrecords]);
    }
    
    //showing request to assigned admin for approval

    public function showRequest()
    {
        $requestrecords = RequestModel::all();

        return view('requests', compact('requestrecords'));
    }

    //showing request to assigned faculty
    public function showRequest2()
    {
        $requestrecords2 = RequestModel::all();
        $rooms = Room::all();

        return view('faculty.managerequest', compact('requestrecords2', 'rooms'));
    }

    //showing request to student
    public function showstudentRequest()
    {
        $requestrecords3 = RequestModel::all();

        return view('student.viewrequest', compact('requestrecords3'));
    }

    public function adminRequestArchive()
    {
        $requestrecords5 = RequestModel::all();

        return view('adminArchiveRequest', compact('requestrecords5'));
    }


    //admin approving request
    public function approveRequest($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'Approved';
        $data->remarks = 'Please wait for your new schedule. Thank you.
                            For Special Exam: Please see your Program Head for the exam details.';
        $data->save();

        return redirect()->back();
        
    }

    //admin rejecting request
    public function rejectRequest($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'Rejected';
        $data->remarks = 'Your data or requirements are invalid. Please check your request and try again.';
        $data->save();

        return redirect()->back();
        
    }

    public function newschedCreated($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'New Schedule Created';
        $data->save();

        return redirect()->back();
        
    }


    //download requirement
    public function requestDownload($filePaths)
    {
        try {
            list($requirement) = explode(',', urldecode($filePaths));

            $requirement_path = "uploads/{$requirement}";

            if (!Storage::exists($requirement_path)) {
                throw new \Exception("Files do not exist. Requirement Path: $requirement_path");
            }

            $zipFileName = 'downloaded_files.zip';
            $zipPath = storage_path("app/$zipFileName");

            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE)) {
                $zip->addFile(storage_path("app/$requirement_path"), $requirement);
                $zip->close();

                return response()->download($zipPath)->deleteFileAfterSend(true);
            } else {
                throw new \Exception("Failed to create a ZIP archive.");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeSched(Request $request)
    {
        $request->validate([
            'stud_name2' => 'required',
            'request_type2' => 'required',
            'subject2' => 'required',
            'instructor2' => 'required',
            'exam_day' => 'required',
            'exam_time' => 'required',
            'room' => 'required',
        ]);
        
        $stud_name2 = $request->stud_name2;
        $request_type2 = $request->request_type2;
        $subject2 = $request->subject2;
        $instructor2 = $request->instructor2;
        $exam_day = $request->exam_day;
        $exam_time = $request->exam_time;
        $room = $request->room;
    
        // Save file information to the database
        $newRequest = NewSched::create([

            'stud_name2' => $stud_name2,
            'request_type2' => $request_type2,
            'subject2' => $subject2,
            'instructor2' => $instructor2,
            'exam_day' => $exam_day,
            'exam_time' => $exam_time,
            'room' => $room,
        ]);

        if (!$newRequest) {
            return redirect(route('faculty.managerequest'))->with('error', 'Application Failed! Try Again!');
        }
    
        return redirect(route('faculty.managerequest'))->with('success', 'New Schedule Made Successfully!');
    }

    public function showstudentNewSched()
    {
        $requestrecords4 = NewSched::all();

        return view('student.newsched', compact('requestrecords4'));
    }
}
