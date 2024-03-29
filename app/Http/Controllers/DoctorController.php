<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->doctor()->latest()->paginate(20);
        return view('pages.doctor.index',compact('rows'));
    }

    public function create()
    {
        $doctor = new User();
        return view('pages.doctor.form',compact('doctor'));
    }


    public function store(DoctorRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 4;
        $inputs['call_center_id'] = auth('callcenter')->id();
        User::create($inputs);
        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }

    public function edit(User $doctor)
    {
        return view('pages.doctor.form',compact('doctor'));
    }


    public function update(DoctorRequest $request, User $doctor)
    {
        $doctor->update($request->all());
        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }


    public function destroy(User $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('message','Done Successfully');
    }

    public function getPatients()
    {
        $doctor = auth('web')->user();
        $rows = User::where('doctor_id',$doctor->id)->latest()->paginate(20);
        return view('pages.doctor.patients',compact('rows', 'doctor'));
    }
}
