<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdverseRequest extends FormRequest
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
        return [
            'report_type'=>'required',
            'patient_initials'=>'required',
            'age'=>'required|min:1',
            'gender'=>'required',
            'reaction_onset_date'=>'required',
            'suspected_novartis_drug'=>'required',
            'dose'=>'required',
            'indication'=>'required',
            'reaction_description'=>'required',
            'is_serious'=>'required',
            'is_drug_related'=>'required',
            'concomitant_medications'=>'required',
            'medical_history'=>'required',
            'batch_number'=>'required',
            'treating_physician'=>'required',
            'reporter_name'=>'required',
            'Date'=>'required',
        ];
    }
}
