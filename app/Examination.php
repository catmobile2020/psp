<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable=['name','date','activated','patient_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id');
    }

    public function getActiveNameAttribute()
    {
        if ($this->activated)
        {
            return 'Activated';
        }
        return 'Deactivated';
    }
}
