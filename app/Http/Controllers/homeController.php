<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\sys_user;

class HomeController extends Controller
{
	public function __construct ()
    {
       date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $data_group = $request->get('data_group');
        $data_menu  = $request->get('data_menu');
        return view('home.hello',
            [
                'data_group'=>$data_group,
                'data_menu' => $data_menu
            ]
        );
    }
    public function login(Request $request)
    {
        $session = $request->session()->exists('username');
        if(!$session){
            return view('auth.login');
        }else{
            return redirect('/');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('username');
        $session = $request->session()->exists('username');
        if(!$session){
            return redirect('/');
        }
    }
    public function cekuser(Request $request)
    {
        $user_name  = $request->input('username');
        $pwd        = $request->input('password');
        $sys_user   = new sys_user();
        $data = $sys_user::where('username',$user_name)->get();
        $user = NULL;
        foreach ($data as $key => $value) {
            $user       = $value->username;
            $password   = $value->password;
            $name       = $value->name;
            $jabatan    = $value->jabatan;
            $level      = $value->level;
            $nik        = $value->nik;
        }
        if($user){
            if (Hash::check($pwd, $password)) {
                session([
                    'nik'=> $nik,
                    'username'=> $user,
                    'name'=> $name,
                    'jabatan'=> $jabatan,
                    'level'=> $level
                ]);
                $session = $request->session()->get('username');
                $this->pengunjung($session);
                if($session){
                    return redirect('/');
                }
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }
    public function pengunjung($user_name)
    {
        $date = date('Y-m-d H:i:s');
        DB::table('sys_pengunjung')->insert(['USER_NAME' => $user_name,'TANGGAL' =>  $date]);
    }
    public function test()
    {
        if (Hash::check('123', '$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6')) {
            echo "ok";
        }
    }
}
