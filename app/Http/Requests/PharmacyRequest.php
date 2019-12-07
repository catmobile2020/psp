<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required',
            'preferred_distributor'=>'required',
        ];

        if ($this->routeIs('pharmacies.update'))
        {
            $roles['username'] ='required|unique:users,username,'.$this->pharmacy->id;
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
