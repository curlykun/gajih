<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userModel;

class debugController extends Controller
{
    public function index(Request $request)
    {
    	$data = userModel::where('jabatan','FACTORY MANAGER')->get();
    	return $data;
    }
}
