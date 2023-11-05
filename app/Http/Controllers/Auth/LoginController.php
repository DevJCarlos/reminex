<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class LoginController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    // public function redirectTo(){

    //     if(Auth::user()->hasRole('admin')){
    //         return route('admin.index');
    //     }elseif(Auth::user()->hasRole('teacher')){
    //         return route('teacher.index');
    //     }else{
    //         return route('student.index');
    //     }

    //     return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
        
    // }

    public function login(Request $request)
    {
        $referer = str_replace(url('/'), '', url()->previous());
        $role = $this->determineRoleFromReferrer($referer);
            
        $userRoles = $this->isRoleMatchingForm($request);
        $userRole = $userRoles->toArray();

        
        if ($role == $userRole[0]) {
            
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                
                $user = Auth::user();
                
                if ($user->hasRole('admin')) {
                    return redirect()->route('admin.index'); 
                } elseif ($user->hasRole('teacher')) {
                    return redirect()->route('faculty.index');
                } elseif ($user->hasRole('student')) {
                    return redirect()->route('student.index'); 
                } else {
                    return redirect()->back()->with('msg', 'mali tanan');
                }
            }
        }else{
            return redirect()->back()->with('msg', 'dli dri mag login');
        }
        return redirect()->back()->with('error', 'Invalid login credentials.');
    }

    private function determineRoleFromReferrer($referer)
    {
        
        if ($referer === '/adminLogin') {
            return 'admin';
        } elseif ($referer === '/facultyLogin') {
            return 'teacher';
        } elseif ($referer === '/') {
            return 'student';
        }else{
            return null;
        }

    }

    private function isRoleMatchingForm($request)
    {
        $userIdentifier = $request->username;
        $user = User::where('username', $userIdentifier)->orWhere('email', $userIdentifier)->first();
        return $user->getRoleNames();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/adminLogin');
        // return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
    }


}
