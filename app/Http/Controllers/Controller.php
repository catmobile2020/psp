<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Nexmo\Laravel\Facade\Nexmo;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSMS($phone, $message)
    {
        try
        {
            Nexmo::message()->send([
                'to'   => $phone,
                'from' => 'PSP System',
                'text' => $message,
                'type'=>'unicode'
            ]);
            return;
        }catch (\Exception $exception)
        {
            return redirect()->back()->with('message','Phone Number is Wrong');
        }
    }
}
