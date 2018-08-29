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

        return view('data_master.upload.uploadAbsensi', [
                    'data_group'=> $data_group,
                    'data_menu'	=> $data_menu,
        ]);
    }
    public function upload(Request $request)
    {
        $rules = [
            'file' => 'required|file|max:1000', // ukuran dihitung dalam KB
        ];

        $customMessages = [
            'max' => 'Ukuran File Lebih dari :max KB',
            'required' => ':attribute Tidak Boleh Kosong.',
        ];

        $this->validate($request, $rules, $customMessages);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');        
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files');
    }
}
