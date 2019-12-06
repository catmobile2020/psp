<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CallCenterRequest extends FormRequest
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
            'program_id'=>'required|exists:programs,id',
        ];

        if ($this->routeIs('callcenters.update'))
        {
            $roles['username'] ='required|unique:call_centers,username,'.$this->callcenter->id;
            if ($this->has('password') and $this->get('password') !== null)
            {
                $roles['password']='required|confirmed|min:6';
            }
        }else
        {
            $roles['username'] ='required|unique:call_centers,username';
            $roles['password'] ='required|confirmed|min:6';
        }
        return $roles;
    }
}
