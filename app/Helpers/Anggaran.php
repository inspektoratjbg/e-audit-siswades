<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Anggaran
{
    public static function komposisiBelanja($tahun,$desa, $pak = 0)
    {
        return DB::select(" EXEC sp_komposisi_belanja".$tahun." @desa='$desa', @pak=$pak");
    }

    public static function PenetapanAnggaran($tahun,$desa)
    {
        $tab='penetapan_anggaran'.$tahun;
        return  DB::table($tab)->where('kd_desa', $desa)->first();
    }

    public static function BelanjaFisik($tahun,$desa)
    {
        return DB::select("EXEC sp_upah_pekerja".$tahun." @desa='$desa'");
    }

    public static function PanjarFisikDD($tahun,$desa)
    {
        return  DB::table('panjarFisikDanaDesa'.$tahun)->where('kd_desa', $desa)->get();
    }

    public static function TotalPanjarFisikDD($tahun,$desa)
    {
        return collect(DB::select("exec sp_total_panjar".$tahun." @desa='$desa'"))->first();
    }

    public static function RingkasanPajak($desa,$tahun)
    {
        $sp='sp_pajak'.$tahun;
        return DB::select("EXEC $sp @desa='$desa'");
    }
}
