<?php

namespace App\Http\Controllers;

use App\Examination;
use App\Http\Requests\TestVoucherRequest;
use App\Http\Requests\VoucherRequest;
use App\Order;
use App\Program;
use App\Test;
use App\User;
use App\Voucher;
use Carbon\Carbon;

class MarketingController extends Controller
{
    public function index()
    {

        $users = User::latest()->get()->groupBy('type')->map(function ($group){
            return array(count($group), $group[0]['created_at']);
        });
        $orders = Order::latest()->get();
        $tests = Test::where('activated', 1)->latest()->get();
        $examinations = Examination::where('activated', 1)->latest()->get();
        $vouchers = Voucher::where('was_used', 1)->latest()->get();
        $rows = User::where('type', 1)->latest()->paginate(25);
        return view('pages.marketing.index',
            compact(
                'users',
                'rows',
                'orders',
                'tests',
                'vouchers',
                'examinations'
                ));
    }

    public function patientStatistics()
    {
        $rows = User::where('type', 1)->latest()->paginate(25);
        $programs = Program::all();
        $programName = array();
        $programCount = array();
        foreach ($programs as $program)
        {
            $program->count = $program->patients->count();
            array_push($programName, $program->name);
            array_push($programCount, $program->count);
        }

        return view('pages.marketing.patient',
            compact(
                'rows',
                'programCount',
                'programName'
            ));
    }

    public function doctorStatistics()
    {
        $rows = User::where('type', 4)->latest()->paginate(25);
        $programs = Program::all();
        $programName = array();
        $programCount = array();
        foreach ($programs as $program)
        {
            $program->count = $program->doctors->count();
            array_push($programName, $program->name);
            array_push($programCount, $program->count);
        }

        return view('pages.marketing.doctor',
            compact(
                'rows',
                'programCount',
                'programName'
            ));
    }

    public function pharmacyStatistics()
    {
        $rows = User::where('type', 2)->latest()->paginate(25);
        $orders = Order::all();

        return view('pages.marketing.pharmacy',
            compact(
                'rows',
                'orders'
            ));
    }

    public function labStatistics()
    {
        $rows = User::where('type', 3)->latest()->paginate(25);
        $tests = Test::all();

        return view('pages.marketing.lab',
            compact(
                'rows',
                'tests'
            ));
    }

    public function healthStatistics()
    {
        $rows = User::where('type', 6)->latest()->paginate(25);
        $tests = Voucher::all();

        return view('pages.marketing.health',
            compact(
                'rows',
                'tests'
            ));
    }

    public function hospitalStatistics()
    {
        $rows = User::where('type', 5)->latest()->paginate(25);
        $tests = Examination::all();

        return view('pages.marketing.hospital',
            compact(
                'rows',
                'tests'
            ));
    }
}
