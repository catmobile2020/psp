<?php

namespace App\Http\Controllers;

use App\Helpers\UploadImage;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use UploadImage;

    public function index()
    {
        $user = auth('web')->user();
        $rows = Order::where('user_id',$user->id)->latest()->paginate(15);
        return view('pages.order.index',compact('rows'));
    }

    public function create()
    {
        return view('pages.order.form');
    }

    public function store(OrderRequest $request)
    {
        $patient = User::where('serial_number',$request->serial_number)->first();
        if (!$patient)
        {
            return redirect()->back()->with('message','Patient serial number Wrong. Try Again!');
        }
        $inputs = $request->all();
        $inputs['patient_id']=$patient->id;
        $has_free = $patient->patientOrders()->latest('id')->first() ? $patient->patientOrders()->latest('id')->first()->has_free : true;
        $user = auth('web')->user();
        $order = $user->orders()->create($inputs);
        if ($order)
        {
            if ($request->photo)
                $this->upload($request->photo,$order);

            $message = "تأكيد شراء علبة";
            $this->sendSMS($patient->phone,$message);

            if (!$has_free)
            {
                $confirmation_code=rand(000000,999999);

                $freeOrder = Order::create([
                    'serial_number'=>$patient->serial_number,
                    'comment'=>'FOC',
                    'has_free'=>true,
                    'confirmation_code'=>$confirmation_code,
                    'activated'=>false,
                    'patient_id'=>$patient->id,

                ]);
                if ($freeOrder)
                {
                    $message = "{$confirmation_code} هذا كود استحقاق العبوة المجانية لبرنامج ايدك فى ايدينا";
                    $this->sendSMS($patient->phone,$message);
                }
            }
        }
        return redirect()->route('orders.index')->with('message','Operation Done Successfully');
    }

    public function foc()
    {
        return view('pages.order.foc');
    }

    public function postFoc(OrderRequest $request)
    {
        $user = auth('web')->user();
        $order = Order::where('serial_number',$request->serial_number)->where('confirmation_code',$request->code)->first();
        if (!$order)
        {
            return redirect()->back()->with('message','Patient serial number Or Code  Wrong. Try Again!');
        }
        if ($order->activated)
        {
            return redirect()->back()->with('message','This Code Used Before !');
        }
        $order->update([
            'activated'=>true,
            'user_id'=>$user->id,
            'confirmation_code'=>null
        ]);
        if ($request->photo)
            $this->upload($request->photo,$order);
        return redirect()->route('orders.index')->with('message','Operation Done Successfully');
    }
}
