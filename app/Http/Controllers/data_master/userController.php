<?php

namespace App\Http\Controllers\data_master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\UserModel;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $data_group 	= $request->get('data_group');
        $data_menu      = $request->get('data_menu');
        $userList 		= $this->show();

        return view('data_master.karyawan.user', [
                    'data_group'=> $data_group,
                    'data_menu'	=> $data_menu,
                    'userList' => $userList,
        ]);
    }

    public function show()
    {
        $data = DB::table('sys_users')->get();
        return Datatables::of($data)->make(true);
    }
    public function save(Request $request)
    {
        $error = "";
        isset($request->nik)?$request->nik: $error .= " Nik is Empty<br>";
        isset($request->name)?$request->name: $error .= " Name is Empty<br>";
        Isset($request->jabatan)?$request->jabatan: $error .= " Position is Empty<br>";
        isset($request->email)?$request->email: $error .= " Email is Empty<br>";
        isset($request->password)?$request->password: $error .= " Password is Empty<br>";

        if($error == ""){
            $count = DB::table('sys_users')->where("nik",$request->nik)->count();
            if($count == 0){
                $username = explode('@', $request->email);
                $password = Hash::make($request->password);
                $insert = DB::table('sys_users')->insert(
                    ['nik' => $request->nik, 'username' => $username[0], 'name' => $request->name, 
                    'jabatan' => $request->jabatan, 'email' => $request->email,'password'=>$password]
                );
                if($insert){
                    return array("msg"=> "success");
                }
            }else{
                return array("msg"=> "Duplicat Data");
            }
        }else{
            return array("msg"=> $error);
        }
        
    }
    public function update(Request $request)
    {
        $error = "";
        isset($request->nik)?$request->nik: $error .= " Nik is Empty<br>";
        isset($request->name)?$request->name: $error .= " Name is Empty<br>";
        Isset($request->jabatan)?$request->jabatan: $error .= " Position is Empty<br>";
        isset($request->email)?$request->email: $error .= " Email is Empty<br>";
        // isset($request->pk)?$request->pk: $error .= " Pk is Empty<br>";

        if($error == ""){
            $count = DB::table('sys_users')->where("nik",$request->nik)->where("nik","<>",$request->nik_hide)->count();
            if($count == 0){
                $username = explode('@', $request->email);
                $insert = DB::table('sys_users')
                            ->where("nik","=",$request->nik_hide)
                            ->update([
                                'nik' => $request->nik, 'name' => $request->name , 
                                'jabatan' => $request->jabatan, 'email' => $request->email, 
                                "username"=>$username[0] 
                            ]);
                if($insert){
                    return array("msg"=> "success");
                }
            }else{
                return array("msg"=> "Duplicat Data");
            }
        }else{
            return array("msg"=> $error);
        }
        
    }
    public function delete(Request $request)
    {
        $arrMenu = array();
        $reqMenu = array();
        $delete = DB::table('sys_users')->where('nik',$request->nik)->delete();
        if($delete){
            //menghapus access menu sesuai nik yg dikirim
            $menu = DB::table('sys_menus')->where('status','Y')->get();
            foreach ($menu as $key => $value) {
                array_push($arrMenu, $value->node_group.$value->node_menu);
            }
            $userMenu = DB::table('sys_menus')->where('status','Y')
                                ->where('nik_access','NOT REGEXP','[[:<:]]'.$request->nik.'[[:>:]]')
                                ->get();
            foreach ($userMenu as $key => $value) {
                array_push($reqMenu, $value->node_group.$value->node_menu);
            }
            foreach ($arrMenu as $key => $valArrMenu) {
                //bandingkan menu yang dipilih sama menu yang ada di DB
                //ambil yang tidak ada
               if(!in_array($valArrMenu, $reqMenu)){
                    $unSelect = DB::table('sys_menus')->where('status','Y')
                                    ->where( DB::RAW('CONCAT(node_group,node_menu)'), $valArrMenu)
                                    ->get();
                    //mengambil nik access dari DB
                    foreach ($unSelect as $key => $valunSelect) {
                        //hapus nik access yang ada di Db sesuai dengan $request->nik
                        $nik_access = array_diff(explode(",", $valunSelect->nik_access), array($request->nik) );
                        //format ulang nik access
                        $setNik = "";
                        foreach ($nik_access as $key => $nik) {
                            $setNik .= $nik.",";
                        }
                        //update nik access yang ada di DB
                        $upd= DB::table('sys_menus')
                                ->where( DB::RAW('CONCAT(node_group,node_menu)'), $valArrMenu)
                                ->update(['nik_access' => rtrim($setNik,",") ]);
                    }
               }

            }

            return array("msg"=> "success");
        }
    }
    public function get(Request $request)
    {
        $data = DB::table('sys_users')->where('nik',$request->nik)->get();
        return $data;
    }
    public function update_useraccess(Request $request)
    {
        
        //list menu yang aktif
        $msg = "";
        $arrMenu = array();
        if(!isset($request->MENU)){
            return array('Minimal ada satu menu yang terpilih');
            exit();
        }
        //menambahkan access user ke menu yang di pilih
        foreach ($request->MENU as $key => $value) {
            //mencari menu sesuai request yg dikirim dan nik access tidak ada
            $select = DB::table('sys_menus')
                        ->where('status','Y')
                        ->where( DB::RAW('CONCAT(node_group,node_menu)'), $value)
                        ->where('nik_access','NOT REGEXP','[[:<:]]'.$request->nik.'[[:>:]]')
                        ->get();
            //jika ada data maka tambahkan nik access
            if($select){
                foreach ($select as $key => $valmenu) {
                    $valNIK = $valmenu->nik_access?$valmenu->nik_access.",":"";
                    $upd = DB::table('sys_menus')
                                ->where( DB::RAW('CONCAT(node_group,node_menu)'), $value)
                                ->update(['nik_access' => $valNIK.$request->nik]);
                    $upd?$msg .= " Update Menu ".$valmenu->menu." Success...\n":$msg .= " Update Menu ".$valmenu->menu." Error...\n";
                }
            }
        }

        //menghapus access menu sesuai nik yg dikirim
        $menu = DB::table('sys_menus')->where('status','Y')->get();
        foreach ($menu as $key => $value) {
            array_push($arrMenu, $value->node_group.$value->node_menu);
        }
        foreach ($arrMenu as $key => $valArrMenu) {
            //bandingkan menu yang dipilih sama menu yang ada di DB
            //ambil yang tidak ada
           if(!in_array($valArrMenu, $request->MENU)){
                $unSelect = DB::table('sys_menus')->where('status','Y')
                                ->where( DB::RAW('CONCAT(node_group,node_menu)'), $valArrMenu)
                                ->get();
                //mengambil nik access dari DB
                foreach ($unSelect as $key => $valunSelect) {
                    //hapus nik access yang ada di Db sesuai dengan $request->nik
                    $nik_access = array_diff(explode(",", $valunSelect->nik_access), array($request->nik) );
                    //format ulang nik access
                    $setNik = "";
                    foreach ($nik_access as $key => $nik) {
                        $setNik .= $nik.",";
                    }
                    //update nik access yang ada di DB
                    $upd= DB::table('sys_menus')
                            ->where( DB::RAW('CONCAT(node_group,node_menu)'), $valArrMenu)
                            ->update(['nik_access' => rtrim($setNik,",") ]);
                    $upd?$msg .="Remove Menu Success...\n":$msg .="Remove Menu Error...\n";
                }
           }

        }


        return array($msg);
    }

    public function listMenu($nik)
    {
        $group          = DB::table('sys_groups')->get();
        $menu           = DB::table('sys_menus')->where('status','Y')->get();
        $checked        = '';
        
        echo '<input name="nik" value="'.$nik.'" type="hidden"/>';
        echo '<div class="list-group"><a href="#" class="list-group-item bg-warning">Menu</a>';
        foreach ($group as $key => $valgroup) {
            echo '<a href="#" class="list-group-item text-dark">';
                echo ' <li class="'.$valgroup->icon.'" style=" margin-right:10px"></li>';
                echo $valgroup->group.'<br>';

                foreach($menu as $key => $valmenu){
                    if($valmenu->node_group == $valgroup->node_group){

                        if(in_array( $nik, explode(",", $valmenu->nik_access) ) ){
                            $checked = 'checked';
                        }else{
                            $checked = '';
                        }
                        echo '<span style=" margin-right:25px"></span><label class="checkbox-inline">';
                            echo '<input type="checkbox" '.$checked.' name="MENU[]" value="'.$valmenu->node_group.$valmenu->node_menu.'">';
                            echo $valmenu->menu;
                        echo '</label><br>';

                    }
                }

            echo '</a>';
        }
        echo '</div>';
    }
    public function tunjangan(Request $request)
    {
        $ret = UserModel::where('nik',$request->nik)->get();
        return $ret;
    }
    public function addTunjangan(Request $request)
    {
        $basic          =  str_replace(",", "", isset($request->basic) ? $request->basic : 0 );
        $bpjs           =  str_replace(",", "", isset($request->bpjs) ? $request->bpjs : 0 );
        $jamsostek      =  str_replace(",", "", isset($request->jamsostek) ? $request->jamsostek : 0 );
        $uang_makan     =  str_replace(",", "", isset($request->uang_makan) ? $request->uang_makan : 0 );
        $uang_transport =  str_replace(",", "", isset($request->uang_transport) ? $request->uang_transport : 0 );

        $userModel = UserModel::AddTunjangan($request->tujangan_nik,$basic, $bpjs, $jamsostek, $uang_makan, $uang_transport); 

        if($userModel == 1){
            $ret = array("msg" => "success");
        }else{
            $ret = array("msg" => "Tunjangan Gagal di Tambahkan.");
        }
        return $ret;
    }
    public function export()
    {
        require_once './vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';

        $helper = new Sample();
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

            return;
        }

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Maarten Balliauw')
            ->setLastModifiedBy('Maarten Balliauw')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xls)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
        exit;
    }
    public function import()
    {
        $inputFileName = './public/uploads/absensi/DUMI_ABSENSI.xlsx';
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        echo "<pre>";
        var_dump($sheetData);
    }
}
