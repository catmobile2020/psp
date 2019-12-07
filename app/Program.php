<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable=['name'];

    public function patients()
    {
        return $this->hasManyThrough('App\User', 'App\CallCenter')->where('users.type', 1);
    }

    public function doctors()
    {
        return $this->hasManyThrough('App\User', 'App\CallCenter')->where('users.type', 4);
    }
}
