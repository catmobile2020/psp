<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roles = [
            'serial_number'=>'required',
            'name'=>'required',
            'email'=>'required|email',
            'national_id'=>'required',
            'age'=>'required|min:1',
            'sex'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'diagnosis'=>'required',
        ];

        if ($this->routeIs('patients.update'))
        {
            $roles['username'] ='required|unique:users,username,'.$this->patient->id;
            if ($this->has('password') and $this->get('password') !== null)
            {
                $roles['password']='required|confirmed|min:6';
            }
        }else
        {
            $roles['username'] ='required|unique:users,username';
            $roles['password'] ='required|confirmed|min:6';
        }
        return $roles;
    }
}
