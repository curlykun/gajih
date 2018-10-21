<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userModel;
use App\LemburModel;
use App\LemburTempModel;

class DebugController extends Controller
{
    public function index(Request $request)
    {
        // $data = userModel::where('jabatan','FACTORY MANAGER')->get();
        
        $keyword2 = "admin";
        $data = LemburModel::with('user')->whereHas('user', function ($query) use ($keyword2) {
            $query->where('nik', 'like',"%{$keyword2}%" )
            ->orWhere('name', 'like',"%{$keyword2}%" );
        })->orderBy('tanggal','desc')->get()->dd();


        // $data_pilih_karyawan  = LemburTempModel::whereHas('user', function ($query) use ($keyword2) {
        //     $query->where('nik', 'like',"%{$keyword2}%" )
        //     ->orWhere('name', 'like',"%{$keyword2}%" )
        //     ->orWhere('jabatan', 'like',"%{$keyword2}%" );
        // })->paginate(10,['*'],'page2');


    	return dd($data_pilih_karyawan);
    }
}
