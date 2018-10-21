<?php

namespace App\Http\Controllers\lembur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LemburModel;
use App\UserModel;
use App\LemburTempModel;
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
        $keyword        = isset($request->keyword)?$request->keyword:'';
        $show           = $this->show($keyword);
        return view('lembur.buat_spl.BuatSpl',compact('data_group','data_menu','show','keyword') );
    }
    public function formSpl(Request $request)
    {   
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $keyword1       = isset($request->keyword1) ? $request->keyword1 : '';
        $keyword2       = isset($request->keyword2) ? $request->keyword2 : '';
        $data_karyawan  = UserModel::where('nik', 'like',"%{$keyword1}%" )
                            ->orWhere('name', 'like',"%{$keyword1}%" )
                            ->orWhere('jabatan', 'like',"%{$keyword1}%" )
                            ->doesnthave('lemburTemp')->paginate(10,['*'],'page1');

        $data_karyawan->appends(['keyword1'=>$request->keyword1,'keyword2'=>$request->keyword2,'page2'=>$request->page2,'page1'=>$request->page1]);

        $data_pilih_karyawan  = LemburTempModel::whereHas('user', function ($query) use ($keyword2) {
                                                $query->where('nik', 'like',"%{$keyword2}%" )
                                                ->orWhere('name', 'like',"%{$keyword2}%" )
                                                ->orWhere('jabatan', 'like',"%{$keyword2}%" );
                                            })->paginate(10,['*'],'page2');

        $data_pilih_karyawan->appends(['keyword1'=>$request->keyword1,'keyword2'=>$request->keyword2,'page2'=>$request->page2,'page1'=>$request->page1]);

        return view('lembur.buat_spl.FormSpl',compact('data_group','data_menu','data_karyawan','data_pilih_karyawan','keyword1','keyword2') );
    }
    public function show($cari)
    {
        $data = LemburModel::with('user')->whereHas('user', function ($query) use ($cari) {
            $query->where('nik', 'like',"%{$cari}%" )
            ->orWhere('tanggal', 'like',"%{$cari}%" )
            ->orWhere('name', 'like',"%{$cari}%" );
        })->orderBy('tanggal','desc')->get();

        return  $data;
    }
    public function pilihKaryawan(Request $request)
    {
        $rules = [
            'nik' => 'required|unique:tb_lembur_temp,nik', 
        ];

        $customMessages = [
            'unique' => ':attribute Sudah Ada.',
        ];

        $this->validate($request, $rules, $customMessages);

        $lamebutTemp = new LemburTempModel();
        $lamebutTemp->nik = $request->nik;
        $lamebutTemp->save();
        if($lamebutTemp){
            return redirect()->back();
        }
    }
    public function BatalKaryawan(Request $request)
    {
        $lamebutTemp = LemburTempModel::where('nik',$request->nik)->delete();
        if($lamebutTemp){
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        $lamebutTemp = LemburTempModel::all();
        foreach ($lamebutTemp as $key => $value) {
            $rules = [
                // 'nik' => 'required|unique:tb_lembur,nik,null,id,tanggal,'.$request->tanggal, 
                'tanggal' => 'required|unique:tb_lembur,tanggal,null,id,nik,'.$value->nik, 
                'masuk' => 'required', 
                'keluar' => 'required',
            ];

            $customMessages = [
                'required' => ':attribute Tidak Boleh Kosong.',
                'unique' => ':attribute Sudah Ada.',
            ];

            $this->validate($request, $rules, $customMessages);

            $lembur = new LemburModel;
            $lembur->nik = $value->nik;
            $lembur->tanggal = $request->tanggal;
            $lembur->masuk = $request->masuk;
            $lembur->keluar = $request->keluar;
            $lembur->save();
        }

        if($lembur){
            LemburTempModel::truncate();
            return back();
        }

    }
}
