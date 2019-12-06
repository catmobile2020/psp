<?php

namespace App\Http\Controllers;

use App\Examination;
use App\Helpers\UploadImage;
use App\Http\Requests\TestRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    use UploadImage;

    public function getTests(User $patient)
    {
        $rows = $patient->patientExamination()->latest()->paginate(15);
        return view('pages.examination.index',compact('rows','patient'));
    }

    public function createTest(User $patient)
    {
        $hospitals = User::hospital()->get();
        return view('pages.examination.form',compact('patient','hospitals'));
    }

    public function storeTest(User $patient,TestRequest $request)
    {
        $inputs = $request->all();
        $inputs['patient_id']= $patient->id;
        Examination::create($inputs);
        return redirect()->route('patient.examinations',$patient->id)->with('message','Done Successfully');
    }

    public function patientTestsIndex(Request $request)
    {
        if ($request->ajax())
        {
            $test=Examination::findOrfail($request->id);
            $test->update(['activated'=>$request->active]);
            // Send SMS
            $test_date =Carbon::parse($test->date)->format('Y-m-d h:i A');
            $lab = $test->user;
            if ($test->activated)
            {
                $message ="تم تاكيد حجزك الموافق {$test_date} لدى مستشفى {$lab->name} العنوان {$lab->address}";
            }else
            {
                $message ="تم الغاء حجزك الموافق {$test_date} لدى مستشفى {$lab->name} العنوان {$lab->address}";
            }
            $this->sendSMS($test->patient->phone,$message);

            return 'Change Successfully To '.$test->active_name;
        }
        $user = auth('web')->user();
        $rows = Examination::where('user_id',$user->id)->latest()->paginate(15);
        return view('pages.examination.patients',compact('rows'));
    }

    public function uploadPatientResult(Request $request,Examination $examination)
    {
        if ($request->photos and count($request->photos))
        {
            foreach ($request->photos as $photo)
            {
                $this->upload($photo,$examination);
            }
            return redirect()->back()->with('message','Done Successfully');
        }
        return redirect()->back()->with('message','photos filed required');
    }
}
