<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desa;
use App\Resiko;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
//use DB;
use PDF;

class FaktorResikoController extends Controller
{
    public function index(Request $request)
    {
		$desa = Desa::first();
		
        if ($request->ajax()) {
            // $desa = Resiko::query();
            $tahun=date('Y');
            // $tahun='.$tahun.';
            $desa=DB::table('faktor_resiko_sort'.$tahun);
            // $desa=DB::table('faktor_resiko_sort2022');
            return Datatables::of($desa)
                ->order(function ($query) {
                    $query->orderBy('total', 'desc');
                })
                ->addColumn('angka', function ($desa) {
                    // return '12';
                    return rand(1, 3);
                })

                ->rawColumns(['angka'])
                ->make(true);
        }
        $res = Resiko::first();
        $tanggal = $res->tanggal ?? '';

        return view('resiko.index', compact('tanggal'));
    }

    public function indexPdf(Request $request)
    {
		$tahun=date('Y');
        // $tahun='.$tahun.';
        $desa=DB::table('faktor_resiko_sort'.$tahun)
        ->leftjoin('ref_desa2020', 'faktor_resiko_sort'.$tahun.'.kd_desa', '=', 'ref_desa2020.Kd_Desa')
        ->leftjoin('ref_kecamatan2020', 'ref_desa2020.Kd_Kec', '=', 'ref_kecamatan2020.Kd_Kec')
        ->select('faktor_resiko_sort'.$tahun.'.*', 'ref_kecamatan2020.Nama_Kecamatan')
        ->orderBy('total', 'desc')->get();
        $desa = $desa->sortBy('Nama_Kecamatan');
        // dd($desa);
        //$desa = Resiko::orderBy('total', 'desc')->get();
        $pdf = PDF::loadview('resiko.pdf', compact('desa'));
        return $pdf->download('resiko.pdf');
        // return $pdf->download('Faktor resiko desa');
    }

    public function refreshData()
    {
        DB::beginTransaction();
        try {
            // exec dbo.generate_faktor_resiko;
            $tahun = date('Y');
            // $tahun='.$tahun.';
            DB::statement("exec dbo.generate_faktor_resiko" . $tahun);
            DB::commit();
            // Semua proses benar
            $pesan = "Data berhasil di perbarui";
            $type = "success";
            $res = DB::table('faktor_resiko_sort' . $tahun)->first();
            $tanggal = $res->tanggal ?? '';
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $pesan = $e->getMessage();
            $type = "warning";
            $tanggal = "";
        }

        return ['type' => $type, 'pesan' => $pesan, "tanggal" => $tanggal];
    }
}
