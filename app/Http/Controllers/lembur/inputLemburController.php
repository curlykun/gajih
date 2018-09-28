<?php

namespace App\Http\Controllers\lembur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lemburModel;
use App\UserModel;
use Carbon\Carbon;

class inputLemburController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $dat_FM         = $this->getFM();
        return view('lembur.input_lembur.inputLembur', [
                    'data_group'=> $data_group,
                    'data_menu'	=> $data_menu,
                    'data_fm'=> $dat_FM,
        ]);
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
