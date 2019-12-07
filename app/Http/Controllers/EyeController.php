<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\Http\Requests\EyeRequest;
use App\User;
use Illuminate\Http\Request;

class EyeController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->eye()->latest()->paginate(20);
        return view('pages.eye.index',compact('rows'));
    }

    public function create()
    {
        $eye = new User();
        $governorates = Governorate::all();
        return view('pages.eye.form',compact('eye', 'governorates'));
    }


    public function store(EyeRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 6;
        $inputs['call_center_id'] = auth('callcenter')->id();
        User::create($inputs);
        return redirect()->route('eyes.index')->with('message','Done Successfully');
    }

    public function edit(User $eye)
    {
        $governorates = Governorate::all();
        return view('pages.eye.form',compact('eye', 'governorates'));
    }


    public function update(EyeRequest $request, User $eye)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $eye->update($request->all());
        return redirect()->route('eyes.index')->with('message','Done Successfully');
    }


    public function destroy(User $eye)
    {
        $eye->delete();
        return redirect()->route('eyes.index')->with('message','Done Successfully');
    }
}
