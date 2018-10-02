<?php

namespace App\Http\Controllers\lembur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lemburModel;
use App\UserModel;
use Carbon\Carbon;
use DataTables;
use Yajra\DataTables\Html\Builder;
use Form;
use Html;

class inputLemburController extends Controller
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
            $data = lemburModel::where('nik',$nik);
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#edit-'.$data->nik.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> '.$data->nik.'</a>';
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
        $nik = $request->session()->get('nik');
    	$rules = [
            'tanggal' => 'required', 
            'masuk' => 'required', 
            'keluar' => 'required', 
            'fm' => 'required', 
        ];

        $customMessages = [
            'required' => ':attribute Tidak Boleh Kosong.'
        ];

        $this->validate($request, $rules, $customMessages);

        // $date = date('Y-m-d', strtotime('17/09/2018') );

        // echo $date;
        // die();
        $lembur = new lemburModel;
        $lembur->nik = $nik;
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
