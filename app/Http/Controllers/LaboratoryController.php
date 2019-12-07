<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\Http\Requests\LaboratoryRequest;
use App\User;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->laboratory()->latest()->paginate(20);
        return view('pages.laboratory.index',compact('rows'));
    }

    public function create()
    {

        $laboratory = new User();
        $governorates = Governorate::all();
        return view('pages.laboratory.form',compact('laboratory', 'governorates'));
    }


    public function store(LaboratoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 3;
        $inputs['call_center_id'] = auth('callcenter')->id();
        User::create($inputs);
        return redirect()->route('laboratories.index')->with('message','Done Successfully');
    }

    public function edit(User $laboratory)
    {
        $governorates = Governorate::all();
        return view('pages.laboratory.form',compact('laboratory', 'governorates'));
    }


    public function update(LaboratoryRequest $request, User $laboratory)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $laboratory->update($request->all());
        return redirect()->route('laboratories.index')->with('message','Done Successfully');
    }


    public function destroy(User $laboratory)
    {
        $laboratory->delete();
        return redirect()->route('laboratories.index')->with('message','Done Successfully');
    }
}
