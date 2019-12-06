<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['serial_number', 'comment', 'has_free', 'confirmation_code', 'activated', 'patient_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id');
    }

    public function getHasFreePhotoAttribute()
    {
        return $this->has_free ? asset('assets/images/free.png') : asset('assets/images/paid.png');
    }
}
