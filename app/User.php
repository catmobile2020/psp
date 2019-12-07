<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email','national_id', 'age', 'sex','address', 'phone', 'diagnosis','type', 'doctor_id','call_center_id', 'password', 'serial_number','foc',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopePatient($q)
    {
        return $q->where('type',1);
    }

    public function scopePharmacy($q)
    {
        return $q->where('type',2);
    }

    public function scopeLaboratory($q)
    {
        return $q->where('type',3);
    }

    public function scopeDoctor($q)
    {
        return $q->where('type',4);
    }

    public function scopeHospital($q)
    {
        return $q->where('type',5);
    }

    public function scopeEye($q)
    {
        return $q->where('type',6);
    }

    public function callCenter()
    {
        return $this->belongsTo('App\CallCenter');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }

    public function examinations()
    {
        return $this->hasMany('App\Examination');
    }

    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }

    public function patientOrders()
    {
        return $this->hasMany('App\Order','patient_id');
    }

    public function patientTests()
    {
        return $this->hasMany('App\Test','patient_id');
    }

    public function patientExamination()
    {
        return $this->hasMany('App\Examination','patient_id');
    }

    public function patientVouchers()
    {
        return $this->hasMany('App\Voucher','patient_id');
    }

    public function doctorRow()
    {
        return $this->belongsTo($this,'doctor_id');
    }

    public function patients()
    {
        return $this->hasMany($this,'doctor_id');
    }

    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }
}
