<?php

namespace App\Helpers;

// use Illuminate\Support\Facades\DB;
use DB;


class DataKeuangan
{
    public static function komposisiBelanja($desa, $pak = 0)
    {
        return DB::select(" EXEC sp_komposisi_belanja @desa='$desa', @pak=$pak");
    }


    public static function spp($desa)
    {
        $spp = collect(DB::select("SELECT sum(Jumlah) jumlah 
        FROM [dbo].[Ta_SPP] 
        WHERE Kd_Desa='$desa'"))->first();
        return $spp->jumlah;
    }

    public static function Kwitansi($desa)
    {
        $res = collect(db::select("SELECT sum(nilai) nilai from (
            select sum(nilai) nilai
                from ta_sppbukti
            where Kd_Desa='$desa' 
            union
            select sum(nilai) from Ta_SPJBukti where Kd_Desa='$desa' ) a"))->first();

        return $res->nilai;
    }

    public static function anggaranPad($desa)
    {
        /*  */
        $res = collect(db::select("SELECT case when sum(anggaranstlhpak) is not null or sum(anggaranstlhpak) !=0 then sum(anggaranstlhpak) else  sum(anggaran) end anggaran
                                    from ta_rab
                                    where kd_desa='$desa' 
                                    and left(Kd_Rincian,1)=4"))->first();

        return $res->anggaran;
    }

    /*  */
    public static function RealisasiPad($desa)
    {

        $res = collect(db::select("SELECT sum(nilai) nilai  from (
                                    select kd_desa,Kd_Rincian,case when D_K='D' then debet else Kredit end nilai
                                    from QrSP_Jurnal
                                    where Kd_Desa='$desa' and LEFT(Kd_Rincian,1)=4 ) a"))->first();

        return $res->nilai;
    }

    public static function AnggaranBelanja($desa)
    {
        /*  */
        $res = collect(db::select("SELECT case when sum(anggaranstlhpak) is not null or sum(anggaranstlhpak) !=0 then sum(anggaranstlhpak) else  sum(anggaran) end anggaran
                                    from ta_rab
                                    where kd_desa='$desa' 
                                    and left(Kd_Rincian,1)=5"))->first();

        return $res->anggaran;
    }

    public static function RealisasiBelanja($desa)
    {

        $res = collect(db::select("SELECT sum(nilai) nilai  from (
            select kd_desa,Kd_Rincian,case when D_K='D' then debet else Kredit end nilai
            from QrSP_Jurnal
            where Kd_Desa='$desa' and LEFT(Kd_Rincian,1)=5 ) a"))->first();

        return $res->nilai;
    }

    public static function silpaTahunLalu($desa)
    {
        $res = collect(db::select("SELECT case when AnggaranStlhPAK is null then anggaran else AnggaranStlhPAK end nilai 
        from Ta_RAB
        where Kd_Desa='$desa'
        and Kd_Rincian='6.1.1.01.'"))->first();

        return $res->nilai;
    }

    public static function PenerimaanPembiayaan($desa)
    {
        $res = collect(db::select("SELECT sum(nilai)  nilai from (
            select kd_desa,Kd_Rincian,case when D_K='D' then debet else Kredit end nilai
            from QrSP_Jurnal
            where Kd_Desa='$desa' and LEFT(Kd_Rincian,3)='6.1' ) a"))->first();

        return $res->nilai;
    }

    public static function PengeluaranPembiayaan($desa)
    {
        $res = collect(db::select("SELECT sum(nilai)  nilai from (
            select kd_desa,Kd_Rincian,case when D_K='D' then debet else Kredit end nilai
            from QrSP_Jurnal
            where Kd_Desa='$desa' and LEFT(Kd_Rincian,3)='6.2' ) a"))->first();
        return $res->nilai;
    }

    public static function pph($desa)
    {
        $res = collect(db::select("SELECT SUM(DEBET) POTONGAN , SUM(KREDIT) SETOR
        FROM QRSP_JURNAL
        WHERE KD_DESA='$desa' AND LEFT(KD_RINCIAN,5) ='7.1.1'"))->first();

        return $res;
    }

    public static function ppd($desa)
    {
        $res = \collect(db::select("        SELECT SUM(DEBET) POTONGAN , SUM(KREDIT) SETOR
        FROM QRSP_JURNAL
        WHERE  KD_DESA='$desa' AND LEFT(KD_RINCIAN,5) ='7.1.2'"))->first();
        return $res;
    }

    public static function kasBank($desa)
    {
        $res = \collect(db::select("SELECT SUM(DEBET) PENERIMAAN ,SUM(KREDIT) PENGELUARAN
        from (
         select debet,Kredit
         from QrSP_Jurnal
         where Kd_Desa='$desa'
         and Kd_Rincian='1.1.1.02.'
         union all
         select debet,Kredit
         from Ta_SaldoAwal
         where Kd_Desa='$desa'
         and Kd_Rincian='1.1.1.02.'
         ) a"))->first();
        return $res;
    }

    public static function kasTunai($desa)
    {
        $res = \collect(db::select("SELECT SUM(DEBET) PENERIMAAN ,SUM(KREDIT) PENGELUARAN
        FROM (
         SELECT DEBET,KREDIT
         FROM QRSP_JURNAL
         WHERE KD_DESA='$desa'
         AND KD_RINCIAN='1.1.1.01.'
         UNION ALL
         SELECT DEBET,KREDIT
         FROM TA_SALDOAWAL
         WHERE KD_DESA='$desa'
         AND KD_RINCIAN='1.1.1.01.'
         ) A"))->first();
        return $res;
    }
}
