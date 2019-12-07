<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestVoucherRequest;
use App\Http\Requests\VoucherRequest;
use App\User;
use App\Voucher;

class VoucherController extends Controller
{
    public function index(User $patient)
    {
        $rows = $patient->patientVouchers()->latest()->paginate(15);
        return view('pages.voucher.index',compact('rows','patient'));
    }

    public function create(User $patient)
    {
        $eyes = User::eye()->get();
        return view('pages.voucher.form',compact('patient','eyes'));
    }

    public function store(User $patient,VoucherRequest $request)
    {
        $inputs = $request->all();
        $inputs['patient_id']= $patient->id;
        $voucher = Voucher::create($inputs);
        if ($voucher)
        {
            $code = $voucher->code;
            $message ="{$code} هذا كود استحقاق الاشعه المجانيه الخاص بك هو لدى مركز {$voucher->user->name} ";
            $this->sendSMS($voucher->patient->phone,$message);
        }
        return redirect()->route('patient.vouchers',$patient->id)->with('message','Done Successfully');
    }

    public function searchVoucher()
    {
        return view('pages.voucher.search');
    }
    public function testVoucher(TestVoucherRequest $request)
    {
        $user = auth('web')->user();
        $patient = User::where('serial_number',$request->serial_number)->first();
        if (!$patient)
        {
            return redirect()->back()->with('message','Patient Card Wrong. Try Again!');
        }
        $voucher = Voucher::where('code',$request->code)->where('patient_id',$patient->id)->first();
        if (!$voucher)
        {
            return redirect()->back()->with('message','Code  Wrong. Try Again!');
        }
        if ($voucher->was_used)
        {
            return redirect()->back()->with('message','This Code Used Before !');
        }
        $voucher->update([
            'was_used'=>true
        ]);
        if ($request->photo)
            $this->upload($request->photo,$voucher);
        return redirect()->back()->with('message','Operation Done Successfully');
    }

    public function myVouchers()
    {
        $user = auth('web')->user();
        $rows =Voucher::where('user_id',$user->id)->latest()->paginate(15);
        return view('pages.voucher.my-vouchers',compact('rows','patient'));
    }
}
