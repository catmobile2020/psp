<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
        return view('pages.auth.admin-login');
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $row = Admin::where(function ($q) use ($username){
            $q->where('username',$username)->orWhere('email',$username);
        })->first();
        if ($row)
        {
            if (Hash::check($request->password,$row->password))
            {
                auth()->guard('admin')->login($row,$request->remember);
                if(auth()->guard('admin')->user()->type == 3)
                    return redirect()->intended('/marketing');
                return redirect()->intended('/admin');
            }
        }
        return redirect()->back()->with('message','Error Your Credential is Wrong');
    }

    public function logout()
    {
        $type = auth()->guard('admin')->user()->type;
        auth()->guard('admin')->logout();
        request()->session()->invalidate();
        if($type == 3)
            return redirect()->route('marketing.login');
        return redirect()->route('admin.login');
    }
}
