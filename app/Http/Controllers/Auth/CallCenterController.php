<?php

namespace App\Http\Controllers\Auth;

use App\CallCenter;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CallCenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:callcenter')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.callcenter-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = CallCenter::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth()->guard('callcenter')->login($row,$request->remember);
                return redirect()->intended('/call-centers');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        auth()->guard('callcenter')->logout();
        request()->session()->invalidate();
        return redirect()->route('callcenter.login');
    }
}
