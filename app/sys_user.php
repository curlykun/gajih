<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sys_user extends Model
{
    protected $primaryKey = 'nik';

    public function absensi()
    {
        return $this->hasMany('App\absensiModel','nik','NIK');
    }

}
