<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class LoginController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getLogin()
    {
        return view('template.front_login.login');
    }

    

    public function postLogin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        // Passwordnya pake bcrypt
        if (Auth::check()) { }
        //1 user wilayah (polri polda)
        //2 admin
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->intended('/dashboard-user');
        } else if (Auth::guard('perusahaan')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 4])) {
            return redirect()->intended('/dashboard-perusahaan');
        } else if (Auth::guard('hrd')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 2])) {
            return redirect()->intended('/dashboard-hrd');
        } else {
            return redirect()->intended('/login');
        }
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } elseif (Auth::guard('perusahaan')->check()) {
            Auth::guard('perusahaan')->logout();
        } elseif (Auth::guard('hrd')->check()) {
            Auth::guard('hrd')->logout();
        }elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect('/');
    }
}
