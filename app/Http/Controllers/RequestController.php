<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\NewSched;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Notifications\requestNotification;
use App\Notifications\newschedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\RequestSubject;


class RequestController extends Controller
{

    //import csv for subjects data
    public function importCSV(Request $request)
    {
        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));

        foreach ($csvData as $row) {
            RequestSubject::create([
                're_courses' => $row[0],
                're_subjects' => $row[1],
                // Add more columns as needed
            ]);
        }

        return redirect()->back()->with('success', 'CSV data imported successfully.');
    }

    //creating student request

    public function storeRequest(Request $request)
    {
        // Extracting request data
        $studName = $request->stud_name;
        $department = $request->department;
        $requestType = $request->request_type;
        $subject = $request->subject;
        $instructor = $request->instructor;
        $reason = $request->reason;
        $time_avail1 = $request->filled('time_avail1') ? Carbon::createFromFormat('H:i', $request->time_avail1)->format('h:i A') : null;
        $time_avail2 = $request->filled('time_avail2') ? Carbon::createFromFormat('H:i', $request->time_avail2)->format('h:i A') : null;

        // Handle file uploads
        $requirement = $request->file('requirement');
        $requirementName = time() . '_' . $requirement->getClientOriginalName();

        $requirement->storeAs('uploads', $requirementName);

       $existingRequest = RequestModel::where('subject', $subject)
            ->where('request_type', $requestType)
            ->where('stud_name', auth()->user()->name)
            ->where(function ($query) {
                $query->where('status', 'Approved')
                    ->orWhere('status', 'New Schedule Created')
                    ->orWhereNull('status');
            })
            ->first();

        // If an existing request is found, return custom error message
        if ($existingRequest) {
            return redirect()->back()->with('error', 'You already have requested this subject.');
        }

        // Validation rules
        $request->validate([
            'stud_name' => 'required',
            'department' => 'required',
            'request_type' => 'required',
            'subject' => [
                'required',
                Rule::unique('student_requests')->where(function ($query) use ($request) {
                    $query->where('subject', $request->subject)
                        ->where('request_type', $request->request_type)
                        ->where('stud_name', auth()->user()->name)
                        ->where(function ($subQuery) {
                            $subQuery->where('status', 'Approved')
                                ->orWhereNull('status');
                        });
                }),
            ],
            'instructor' => 'required',
            'reason' => 'required',
            'time_avail1' => 'nullable',
            'time_avail2' => 'nullable',
            'requirement' => 'required|mimes:pdf,doc,docx|max:3000',
        ]);                

        $newRequest = RequestModel::create([
            'stud_name' => $studName,
            'department' => $department,
            'request_type' => $requestType,
            'subject' => $subject,
            'instructor' => $instructor,
            'reason' => $reason,
            'time_avail1' => $time_avail1,
            'time_avail2' => $time_avail2,
            'file_name' => $requirement->getClientOriginalName(),
            'file_path' => $requirementName,
        ]);

        // Notify only the admin with the same department
        $admins = User::where('role', 'admin')->where('department', $department)->get();
        foreach ($admins as $admin) {
            $admin->notify(new requestNotification($request->stud_name, $request->request_type, $request->subject, $newRequest->id));
        }

        $teachers = User::where('role', 'teacher')->where('name', $instructor)->get();
        foreach ($teachers as $teacher) {
            $teacher->notify(new requestNotification($request->stud_name, $request->request_type, $request->subject, $newRequest->id));
        }


        if (!$newRequest) {
            return redirect(route('student.createrequest'))->with('error', 'Application Failed! Try Again!');
        }

        return redirect(route('student.createrequest'))->with('success', 'Successfully Requested!');
    }

    //deleting all requests
    // public function destroyAllRequests()
    // {
    //     try {
    //         // Delete all records from the RequestModel table
    //         DB::table('student_requests')->delete();

    //         // Optionally, you may also want to delete associated files from storage
    //         // You can get the file paths from the database before deleting the records
    //         $filePaths = RequestModel::pluck('file_path')->toArray();
    //         foreach ($filePaths as $filePath) {
    //             Storage::delete('uploads/' . $filePath);
    //         }

    //         return redirect()->back()->with('success', 'All requests deleted successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to delete requests.');
    //     }
    // }

    // fetching data for dropdown selection
    public function createRequest()
    {
        $userrecords = User::all();
        $subjectrecs = RequestSubject::all();
        return view('student.createrequest', compact('userrecords', 'subjectrecs'));
    }

    // public function destroyRequest($id)
    // {
    //     // Find the request by ID
    //     $request = RequestModel::find($id);

    //     if (!$request) {
    //         return redirect(route('adminArchiveRequest'))->with('error', 'Request not found!');
    //     }

    //     // Delete the file from storage
    //     Storage::delete('uploads/' . $request->file_path);

    //     // Delete the request from the database
    //     $request->delete();

    //     return redirect(route('adminArchiveRequest'))->with('success', 'Request deleted successfully!');
    // }
    
    //showing request to assigned admin for approval *FirstCome-FirstServed basis*
    public function showRequest()
    {
        $requestrecords = RequestModel::all();

        return view('requests', compact('requestrecords'));
    }

    //showing request to assigned faculty *FirstCome-LastPlace basis*
    public function showRequest2()
    {
        $requestrecords2 = RequestModel::all();
        $rooms = Room::all();

        return view('faculty.managerequest', compact('requestrecords2', 'rooms'));
    }

    public function showRequest3()
    {
        $requestrecords21 = RequestModel::orderBy('created_at', 'desc')->get();

        return view('faculty.studspecial', compact('requestrecords21'));
    }

    //showing request to student
    public function showstudentRequest()
    {
        $requestrecords3 = RequestModel::orderBy('created_at', 'desc')->get();

        return view('student.viewrequest', compact('requestrecords3'));
    }

    public function adminRequestArchive()
    {
        $requestrecords5 = RequestModel::orderBy('created_at', 'desc')->get();

        return view('adminArchiveRequest', compact('requestrecords5'));
    }


    //admin approving request
    public function approveRequest($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'Approved';
        $data->remarks = 'Please wait for your new schedule. Thank you.';
        $data->save();

        return redirect()->back();
        
    }

    public function approveRequest2($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'Approved';
        $data->remarks = "Please see your Instructor for the exam details.";

        $data->save();

        return redirect()->back();
        
    }

    public function finishRequest($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'Completed';

        $data->save();

        return redirect()->back();
        
    }

    //admin rejecting request
    public function rejectRequest(Request $request, $id)
    {
        $request->validate([
            'rejectreason' => 'required', // Add validation for the rejection reason textarea
        ]);

        $data = RequestModel::find($id);

        $data->status = 'Rejected';
        $data->remarks = $request->rejectreason; // Update the remarks with the rejection reason
        $data->save();

        return redirect()->back();
    }

    //faculty created new schedule

    public function newschedCreated($id)
    {
        $data = RequestModel::find($id);

        $data->status = 'New Schedule Created';
        $data->save();

        return redirect()->back();
        
    }

    //download requirement for admin
    public function requestDownload($filePaths)
    {
        try {
            list($requirement) = explode(',', urldecode($filePaths));

            $requirement_path = "uploads/{$requirement}";

            if (!Storage::exists($requirement_path)) {
                throw new \Exception("Files do not exist. Requirement Path: $requirement_path");
            }

            return response()->download(storage_path("app/$requirement_path"), $requirement);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //download requirement for student
    public function requestDownload2($filePaths)
    {
        try {
            list($requirement) = explode(',', urldecode($filePaths));

            $requirement_path = "uploads/{$requirement}";

            if (!Storage::exists($requirement_path)) {
                throw new \Exception("Files do not exist. Requirement Path: $requirement_path");
            }

            return response()->download(storage_path("app/$requirement_path"), $requirement);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //creating new schedule for student

    public function storeSched(Request $request)
    {
        // Extracting request data
        $studName = $request->stud_name2;
        $requestType = $request->request_type2;
        $subject = $request->subject2;
        $instructor = $request->instructor2;
        $examDay = $request->exam_day;
        $examTime = Carbon::createFromFormat('H:i', $request->exam_time)->format('h:i A');
        $examTime2 = Carbon::createFromFormat('H:i', $request->exam_time2)->format('h:i A');
        $room = $request->room;

        // Check if a schedule with the same subject, request type, and instructor already exists
        $existingSchedule = NewSched::where('subject2', $subject)
            ->where('request_type2', $requestType)
            ->where('instructor2', $instructor)
            ->first();

        // If an existing schedule is found, return custom error message
        if ($existingSchedule) {
            return redirect(route('faculty.managerequest'))->with('error', 'You already have created a new schedule for this request!');
        }

        // Validation rules
        $request->validate([
            'stud_name2' => 'required',
            'request_type2' => 'required',
            'subject2' => [
                'required',
                Rule::unique('new_schedule')->where(function ($query) use ($request) {
                    return $query->where('subject2', $request->subject2)
                        ->where('request_type2', $request->request_type2)
                        ->where('instructor2', $request->instructor2);
                }),
            ],
            'instructor2' => 'required',
            'exam_day' => 'required',
            'exam_time' => 'required',
            'exam_time2' => 'required',
            'room' => 'required',
        ]);

        // Save schedule information to the database
        $newSchedule = NewSched::create([
            'stud_name2' => $studName,
            'request_type2' => $requestType,
            'subject2' => $subject,
            'instructor2' => $instructor,
            'exam_day' => $examDay,
            'exam_time' => $examTime,
            'exam_time2' => $examTime2,
            'room' => $room,
        ]);

        // Notify only the student with the same name
        $students = User::where('role', 'student')->where('name', $studName)->get();
        foreach ($students as $student) {
            $student->notify(new newschedNotification($request->subject2, $newSchedule->id));
        }

        // Check if the schedule was saved successfully
        if (!$newSchedule) {
            return redirect(route('faculty.managerequest'))->with('error', 'Failed to create a new schedule. Please check for conflicts and try again.');
        }

        // Redirect with success message
        return redirect(route('faculty.managerequest'))->with('success', 'New Schedule Made Successfully!');
    }

    //showing faculty the new sched created

    public function showfacultyNewSched()
    {
        $newscheds = NewSched::orderBy('created_at', 'desc')->get();

        return view('faculty.createdNewsched', compact('newscheds'));
    }

    public function showstudentNewSched()
    {
        $requestrecords4 = NewSched::orderBy('created_at', 'desc')->get();

        return view('student.newsched', compact('requestrecords4'));
    }


    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('requests'); // Change the route accordingly
    }

    public function studentmarkAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('student.newsched'); // Change the route accordingly
    }

    public function teachermarkAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('faculty.managerequest'); // Change the route accordingly
    }

    public function checkScheduleExists(Request $request)
    {
        $subject = $request->input('subject2'); // Updated to match the input name in your form
        $studentName = $request->input('stud_name2');

        $exists = NewSched::where('subject2', $subject)
                        ->where('stud_name2', $studentName)
                        ->exists();

        return response()->json(['exists' => $exists]);
    }


    
}
