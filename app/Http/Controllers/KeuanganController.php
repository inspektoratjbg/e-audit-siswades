<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desa;
// use App\Helpers\DataKeuangan as HelpersDataKeuangan;
// use DataKeuangan;
use DB;

class KeuanganController extends Controller
{
    //

    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();

            DB::statement("EXEC dbo.ringkasan_keuangan".$tahun." '".$kd_desa."'");
            

            $result = db::select("select * from [ringkasan_keuangan_desa]
                where kd_desa='" . $kd_desa . "' and tahun='".$tahun."'");
                return view('keuangan._ringkasan',\compact('desa','result','kd_desa','tahun'));
        }
        return view('keuangan.index');
    }
}
