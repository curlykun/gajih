<?php

namespace App\Http\Controllers\lembur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApprovLemburController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        return view('lembur.approv_lembur.approvLembur',
            compact('data_group','data_menu') 
        );
    }
}
