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

class InputLemburController extends Controller
{
    public function __construct(Builder $htmlBuilder)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->htmlBuilder = $htmlBuilder;
    }
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $nik = $request->session()->get('nik');
            $data = LemburModel::where('nik',$nik)->orderBy('tanggal','desc');
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $info = '';
                    switch ($data->approv) {
                        case null:
                            $info = '<h5 class="text-warning"><i class="fa fa-clock-o"></i> Menunggu... </h5>';
                            break;
                        
                        case 0:
                            $info = '<h5 class="text-danger"><i class="fa fa-times"></i> Ditolak </h5>';
                            break;
                        
                        case 1:
                            $info = '<h5 class="text-success"><i class="fa fa-check"></i> Disetujui </h5>';
                            break;
                    }
                    return $info;
                })
                ->toJson();
        }
        $html = $this->htmlBuilder
                ->addColumn(['data' => 'nik', 'name' => 'nik', 'title' => 'NIK'])
                ->addColumn(['data' => 'tanggal', 'name' => 'tanggal', 'title' => 'TANGGAL'])
                ->addColumn(['data' => 'masuk', 'name' => 'masuk', 'title' => 'MASUK'])
                ->addColumn(['data' => 'keluar', 'name' => 'keluar', 'title' => 'KELUAR'])
                ->addAction(['name' => 'action','title' => 'APPROV'])
                ->parameters([
                    "sDom" =>'tipr', 
                    "responsive" => true,
                    "serverSide" => true,
                ]);

        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $data_fm        = $this->getFM();
        return view('lembur.input_lembur.inputLembur',compact('data_group','data_menu','data_fm','html') );
    }
    public function getFM()
    {
       $data = UserModel::where('jabatan','FACTORY MANAGER')->get();
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
