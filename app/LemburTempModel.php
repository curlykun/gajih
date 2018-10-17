<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LemburTempModel extends Model
{
    protected $table = "tb_lembur_temp";
   	public $timestamps = false;
	protected $primaryKey = 'nik';
	
	public function user()
	{
		return $this->hasOne('App\UserModel', 'nik', 'nik');
	}
	
}
