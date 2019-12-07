<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\Http\Requests\HospitalRequest;
use App\User;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->hospital()->latest()->paginate(20);
        return view('pages.hospital.index',compact('rows'));
    }

    public function create()
    {
        $hospital = new User();
        $governorates = Governorate::all();
        return view('pages.hospital.form',compact('hospital', 'governorates'));
    }


    public function store(HospitalRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 5;
        $inputs['call_center_id'] = auth('callcenter')->id();
        User::create($inputs);
        return redirect()->route('hospitals.index')->with('message','Done Successfully');
    }

    public function edit(User $hospital)
    {
        $governorates = Governorate::all();
        return view('pages.hospital.form',compact('hospital', 'governorates'));
    }


    public function update(HospitalRequest $request, User $hospital)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $hospital->update($request->all());
        return redirect()->route('hospitals.index')->with('message','Done Successfully');
    }


    public function destroy(User $hospital)
    {
        $hospital->delete();
        return redirect()->route('hospitals.index')->with('message','Done Successfully');
    }
}
