<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adverse extends Model
{
    protected $fillable =[
        'report_type','patient_initials','age','gender','reaction_onset_date','suspected_novartis_drug','dose',
        'indication','reaction_description','is_serious','is_drug_related','concomitant_medications',
        'medical_history','batch_number','treating_physician','reporter_name','Date','call_center_id'
    ];

    public function callCenter()
    {
        return $this->belongsTo('App\CallCenter','call_center_id');
    }
}
