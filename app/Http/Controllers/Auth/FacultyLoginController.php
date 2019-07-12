<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Faculty;

class FacultyLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:faculty');
    }

    public function showLoginForm()
    {
        return view('auth.faculty-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

        if (Auth::guard('faculty')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $faculty = Faculty::where('email', $request->email)->first();

            if($faculty->status == 0){
                return redirect()->route('addAttendance');

            }
            else {
                return redirect()->route('addClass');
            }
        }

        return redirect()->back()->withInput($request->only('password', 'email', 'remember'))->withErrors([
                'email' => 'These credentials do not match our records.'
            ]);
    }
}
