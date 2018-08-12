<?php

namespace App\Http\Controllers\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class uploadAbsensiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');

        return view('data_master.uploadAbsensi', [
                    'data_group'=> $data_group,
                    'data_menu'	=> $data_menu,
        ]);
    }
}
