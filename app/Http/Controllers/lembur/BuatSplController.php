<?php

namespace App\Http\Controllers\lembur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LemburModel;
use App\UserModel;
use Carbon\Carbon;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Form;
use Html;

class BuatSplController extends Controller
{
    public function __construct(Builder $htmlBuilder)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->htmlBuilder = $htmlBuilder;
    }
    public function index(Request $request)
    {       
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $dataHRD        = $this->getHRD();
        return view('lembur.buat_spl.BuatSpl',compact('data_group','data_menu','dataHRD') );
    }
    public function formSpl(Request $request)
    {       
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $data_karyawan  = UserModel::paginate(10);
        return view('lembur.buat_spl.FormSpl',compact('data_group','data_menu','data_karyawan') );
    }
    public function show(Request $request)
    {
        $nik  = $request->session()->get('nik');
        $data = LemburModel::where('nik',$nik)->orderBy('tanggal','desc');
        return  DataTables::of($data)->make();
    }
    public function getHRD()
    {
       $data = UserModel::where('jabatan','HRD')->get();
        return $data;
    }
    public function store(Request $request)
    {
    	$rules = [
            'nik' => 'required|unique:tb_lembur,nik,null,id,tanggal,'.$request->tanggal, 
            'tanggal' => 'required|unique:tb_lembur,tanggal,null,id,nik,'.$request->nik, 
            'masuk' => 'required', 
            'keluar' => 'required', 
            'fm' => 'required', 
        ];

        $customMessages = [
            'required' => ':attribute Tidak Boleh Kosong.',
            'unique' => ':attribute Sudah Ada.',
        ];

        $this->validate($request, $rules, $customMessages);

        // $date = date('Y-m-d', strtotime('17/09/2018') );

        // echo $date;
        // die();
        $lembur = new LemburModel;
        $lembur->nik = $request->nik;
        $lembur->tanggal = $request->tanggal;
        $lembur->masuk = $request->masuk;
        $lembur->keluar = $request->keluar;
        $lembur->nik_approv = $request->fm;
        $lembur->save();
        
        if($lembur){
            return back();
        }
    }
}
