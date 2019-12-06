<?php

namespace App\Http\Controllers;

use App\Adverse;
use App\Http\Requests\AdverseRequest;
use Illuminate\Http\Request;

class AdverseController extends Controller
{
    public function index()
    {
//        if (auth('callcenter')->check())
//        {
//            $rows = Adverse::where('call_center_id',auth('callcenter')->id())->latest()->paginate(20);
//        }else
//        {
            $rows = Adverse::latest()->paginate(20);
//        }

        return view('pages.adverse.index',compact('rows'));
    }

    public function create()
    {
        return view('pages.adverse.form');
    }

    public function store(AdverseRequest $request)
    {
        $inputs = $request->all();
        $inputs['call_center_id'] = auth('callcenter')->id();
        Adverse::create($inputs);
        return redirect()->back()->with('message','Done Successfully');
    }

}
