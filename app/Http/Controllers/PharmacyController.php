<?php

namespace App\Http\Controllers;

use App\Governorate;
use App\Http\Requests\PharmacyRequest;
use App\User;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $auth_user =auth('callcenter')->user();
        $rows = $auth_user->users()->pharmacy()->latest()->paginate(20);
        return view('pages.pharmacy.index',compact('rows'));
    }

    public function create()
    {
        $pharmacy = new User();
        $governorates = Governorate::all();
        return view('pages.pharmacy.form',compact('pharmacy', 'governorates'));
    }


    public function store(PharmacyRequest $request)
    {
        $inputs = $request->all();
        $inputs['type'] = 2;
        $inputs['call_center_id'] = auth('callcenter')->id();
        User::create($inputs);
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }

    public function edit(User $pharmacy)
    {
        $governorates = Governorate::all();
        return view('pages.pharmacy.form',compact('pharmacy', 'governorates'));
    }


    public function update(PharmacyRequest $request, User $pharmacy)
    {
        if (!$request->password)
        {
            unset($request['password']);
        }
        $pharmacy->update($request->all());
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }


    public function destroy(User $pharmacy)
    {
        $pharmacy->delete();
        return redirect()->route('pharmacies.index')->with('message','Done Successfully');
    }
}
