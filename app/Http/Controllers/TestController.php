<?php

namespace App\Http\Controllers;

use App\Helpers\UploadImage;
use App\Http\Requests\TestRequest;
use App\Test;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use UploadImage;

    public function getTests(User $patient)
    {
        $rows = $patient->patientTests()->latest()->paginate(15);
        return view('pages.test.index',compact('rows','patient'));
    }

    public function createTest(User $patient)
    {
        $labs = User::laboratory()->get();
        return view('pages.test.form',compact('patient','labs'));
    }

    public function storeTest(User $patient,TestRequest $request)
    {
        $inputs = $request->all();
        $inputs['patient_id']= $patient->id;
        Test::create($inputs);
        return redirect()->route('patient.tests',$patient->id)->with('message','Done Successfully');
    }

    public function patientTestsIndex(Request $request)
    {
        if ($request->ajax())
        {
            $test=Test::findOrfail($request->id);
            $test->update(['activated'=>$request->active]);
            // Send SMS
            $test_date =Carbon::parse($test->date)->format('Y-m-d h:i A');
            $lab = $test->user;
            if ($test->activated)
            {
                $message ="تم تاكيد حجزك الموافق {$test_date} لدى معمل {$lab->name} العنوان {$lab->address}";
            }else
            {
                $message ="تم الغاء حجزك الموافق {$test_date} لدى معمل {$lab->name} العنوان {$lab->address}";
            }
            $this->sendSMS($test->patient->phone,$message);

            return 'Change Successfully To '.$test->active_name;
        }
        $user = auth('web')->user();
        $rows = Test::where('user_id',$user->id)->latest()->paginate(15);
        return view('pages.test.patients',compact('rows'));
    }

    public function uploadPatientResult(Request $request,Test $test)
    {
        if ($request->photos and count($request->photos))
        {
            foreach ($request->photos as $photo)
            {
                $this->upload($photo,$test);
            }
            return redirect()->back()->with('message','Done Successfully');
        }
        return redirect()->back()->with('message','photos filed required');
    }
}
