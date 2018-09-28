<?php

namespace App\Http\Controllers\data_master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Http\Controllers\Controller;
use App\absensiModel;
use App\sys_user;
use DataTables;

class debugController extends Controller
{
   	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
	}

    public function index(Request $request)
    {
        return $this->tahun();
    }

    
    public function tahun()
    {
        $data = absensiModel::selectRaw(' date_format(tanggal,"%Y") as year ')->groupBy('year')->get();
        return $data;
    }

    
}
