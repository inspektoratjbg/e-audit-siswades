<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Anggaran;
// use App\Bop;
use App\Desa;
// use App\Upah;
// use App\PanjarFisik;
// use App\Pajak;
// use Yajra\Datatables\Datatables;
use PDF;
use AnggaranData;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();
            $data = AnggaranData::PenetapanAnggaran($tahun,$kd_desa);
            return view('keuangan._apbdes', \compact('data', 'desa','tahun'));
        }
        return view('keuangan.apbdes');
    }


    public function ProyeksiBop(Request $request)
    {
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $pak = $request->pak;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();
            $status = $pak == 1 ? 'Perubahan' : 'Awal';
            $data = AnggaranData::komposisiBelanja($tahun,$kd_desa, $pak);
            return view('keuangan._bop', \compact('data','tahun', 'status', 'desa', 'kd_desa', 'pak'));
        }
        return view('keuangan.bop');
    }

    function ProyeksiBopPdf(Request $request)
    {
        $kd_desa = $request->kd_desa;
        $pak = $request->pak;
        $tahun=$request->tahun;
        $desa = Desa::where('Kd_Desa', $kd_desa)->first();
        $status = $pak == 1 ? 'Perubahan' : 'Awal';
        $data = AnggaranData::komposisiBelanja($tahun,$kd_desa, $pak);

        $pdf = PDF::loadview('keuangan._bop_pdf', compact('tahun','data', 'status', 'desa', 'kd_desa', 'pak'));
        $title = "proyeksi BOP " . $desa->Nama_Desa;
        return $pdf->download($title);
    }

    public function belanjaFisik(Request $request)
    {
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $pak = $request->pak;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();
            $status = $pak == 1 ? 'Perubahan' : 'Awal';
            $data = AnggaranData::BelanjaFisik($tahun,$kd_desa, $pak);
            return view('keuangan._upahfisik', \compact('data', 'status', 'desa', 'pak', 'kd_desa','tahun'));
        }
        return view('keuangan.upahfisik');
    }

    public function belanjaFisikpdf(Request $request)
    {
        $kd_desa = $request->kd_desa;
        $pak = $request->pak;
        $tahun=$request->tahun;
        $desa = Desa::where('Kd_Desa', $kd_desa)->first();
        $status = $pak == 1 ? 'Perubahan' : 'Awal';
        $data = AnggaranData::BelanjaFisik($tahun,$kd_desa, $pak);
        $pdf = PDF::loadview('keuangan._upahfisik_pdf', \compact('data', 'status', 'desa', 'pak', 'kd_desa','tahun'));
        $title = "Upah Pekerja Belanja FIsik " . $desa->Nama_Desa;
        return $pdf->download($title);
    }

    public function panjarFisikDanaDesa(Request $request)
    {
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();
            $data = AnggaranData::PanjarFisikDD($tahun,$kd_desa);
            $total = AnggaranData::TotalPanjarFisikDD($tahun,$kd_desa);
            return view('keuangan._panjarddfisik', \compact('data', 'desa', 'total', 'kd_desa','tahun'));
        }
        return view('keuangan.panjarddfisik');
    }

    public function panjarFisikDanaDesaPdf(Request $request)
    {
        $kd_desa = $request->kd_desa;
        $tahun=$request->tahun;
        $desa = Desa::where('Kd_Desa', $kd_desa)->first();
        $data = AnggaranData::PanjarFisikDD($tahun,$kd_desa);
        $total = AnggaranData::TotalPanjarFisikDD($tahun,$kd_desa);
        $pdf = PDF::loadview('keuangan._panjarddfisik_pdf', \compact('data', 'desa', 'total','tahun'));
        $title = "SPP PANJAR DANA DESA KEGIATAN BELANJA FISIK " . $desa->Nama_Desa;
        return $pdf->download($title);
    }

    public function SektorPajak(Request $request)
    {
        if ($request->ajax()) {
            $kd_desa = $request->kd_desa;
            $tahun=$request->tahun;
            $desa = Desa::where('Kd_Desa', $kd_desa)->first();
            $data = AnggaranData::RingkasanPajak($kd_desa,$tahun);
            return view('keuangan._pajak', \compact('data', 'desa','kd_desa','tahun'));
        }
        return view('keuangan.pajak');
    }

    public function SektorPajakPdf(Request $request)
    {
        $kd_desa = $request->kd_desa;
        $tahun=$request->tahun;
        $desa = Desa::where('Kd_Desa', $kd_desa)->first();
        $data = AnggaranData::RingkasanPajak($kd_desa,$tahun);
        $pdf = PDF::loadview('keuangan._pajak_pdf', \compact('data', 'desa','tahun'));
        $title = "Ringkasan pajak " . $desa->Nama_Desa;
        return $pdf->download($title);
    }
}
