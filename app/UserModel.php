<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
   protected $table = "sys_users";
   public $timestamps = false;
   protected $primaryKey = 'nik';

    public static function AddTunjangan($nik,$basic, $bpjs, $jamsostek, $uang_makan, $uang_transport)
    {
      $ret = UserModel::where('nik',$nik)
                        ->update([  
                          'basic'=>$basic,
                          'bpjs'=>$bpjs,
                          'jamsostek'=>$jamsostek,
                          'uang_makan'=>$uang_makan,
                          'uang_transport'=>$uang_transport
                        ]);
      return $ret;
    }
    public function lemburTemp()
    {
        return $this->belongsTo('App\LemburTempModel','nik','nik');
    }
}
