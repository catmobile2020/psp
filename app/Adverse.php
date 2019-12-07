<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adverse extends Model
{
    protected $fillable =['message','call_center_id'];

    public function callCenter()
    {
        return $this->belongsTo('App\CallCenter','call_center_id');
    }
}
