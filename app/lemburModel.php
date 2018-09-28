<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lemburModel extends Model
{
    protected $table = "tb_lembur";
   	public $timestamps = false;
   	protected $primaryKey = 'nik';
}
