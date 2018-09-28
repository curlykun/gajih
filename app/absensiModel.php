<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class absensiModel extends Model
{
    protected $table = "tb_absensi";
   	public $timestamps = false;
   	protected $primaryKey = 'NIK';

	public function scopeCheck($query,$nik,$tanggal)
	{
		return $query->where('NIK',$nik)->where('tanggal',$tanggal);
	}

  public function sys_user()
  {
      return $this->belongsTo('App\sys_user','nik','nik');
  }

  // //Accessor
  // public function getTanggalAttribute($value)
  // {
  //     return date( 'Y',strtotime($value) );
  // }

  // //Mutator
  // public function setTanggalAttribute($value)
  // {
  //     $this->attributes['tanggal'] = date( 'Y',strtotime($value) );
  // }
}
