<?php

namespace App\Http\Controllers\data_master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Http\Controllers\Controller;
use App\AbsensiModel;
use App\sys_user;
use DataTables;

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
        $tahun          = $this->tahun();

        return view('data_master.upload.uploadAbsensi', [
                    'data_group'=> $data_group,
                    'data_menu' => $data_menu,
                    'tahun'	=> $tahun,
        ]);
    }
    public function tahun()
    {
        $data = AbsensiModel::selectRaw(' date_format(tanggal,"%Y") as year ')->groupBy('year')->orderBy('year','desc')->get();
        return $data;
    }
    public function upload(Request $request)
    {
        $rules = [
            'file' => 'required|file|max:1000|mimes:xlsx,XLSX', // ukuran dihitung dalam KB
        ];

        $customMessages = [
            'max' => 'Ukuran File Lebih dari :max KB',
            'required' => ':attribute Tidak Boleh Kosong.',
            'mimes' => 'File yang di upload harus memiliki tipe xlsx. ',
        ];

        $this->validate($request, $rules, $customMessages);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');        
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->storeAs('public/files/'.date('Ym'), date('Ym').'.xlsx' );
        
        return redirect()->route('upload_absensi.store');
    }
    public function store()
    {
        $inputFileName  = './public/storage/files/'.date('Ym').'/'.date('Ym').'.xlsx';
        $spreadsheet    = IOFactory::load($inputFileName);
        $sheetData      = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        foreach ($sheetData as $key => $value) {
            if($key > 1){
                $c = AbsensiModel::check($value['A'],$value['C'])->count();
                if( $c == 0 ){
                    $query = new AbsensiModel();
                    $query->nik = $value['A'];
                    $query->tanggal = date('Y-m-d',strtotime( $value['C']) );
                    $query->masuk = $value['D'];
                    $query->keluar = $value['E'];
                    $query->save();
                }else{
                    return redirect()->route('upload_absensi')->withErrors(['error'=>'Duplikat data : '.$value['A'].' - '.$value['C'] ]);
                }
            }
        }
        return back();
    }
    public function getBasicData(Request $request)
    {
        $absensis = AbsensiModel::with('sys_user')->whereYear('tanggal',$request->tahun)->whereMonth('tanggal',$request->bulan)->get();
        return Datatables::of($absensis)->make();
    }
}
