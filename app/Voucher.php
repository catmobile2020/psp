<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable=['code','was_used','notes','patient_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id');
    }
}
