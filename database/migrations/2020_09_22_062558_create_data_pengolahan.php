<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengolahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      /*   DB::statement("CREATE view bobot_bop as
                        SELECT  a.kd_desa,a.jumlah,b.jumlah bop,c.jumlah non_bop, 
                        CASE WHEN a.jumlah > 0 THEN CAST((b.jumlah/a.jumlah) * 100 AS DECIMAL(10,2)) ELSE 0 END persen_bop,
                        CASE WHEN   CASE WHEN a.jumlah > 0 THEN CAST((b.jumlah/a.jumlah) * 100 AS DECIMAL(10,2)) ELSE 0 END < 30 THEN 1 
                        WHEN CASE WHEN a.jumlah > 0 THEN CAST((b.jumlah/a.jumlah) * 100 AS DECIMAL(10,2)) ELSE 0 END =30 THEN 2 
                        ELSE 3 END bobot_bop,
                        a.jumlah_pak,b.jumlah_pak bop_pak,c.jumlah_pak non_bop_pak, 
                        CASE WHEN a.jumlah_pak > 0 THEN CAST((b.jumlah_pak/a.jumlah_pak) * 100 AS DECIMAL(10,2)) ELSE 0 END persen_bop_pak,
                        CASE WHEN  CASE WHEN a.jumlah_pak > 0 THEN CAST((b.jumlah_pak/a.jumlah_pak) * 100 AS DECIMAL(10,2)) ELSE 0 END < 30 THEN 1 
                        WHEN CASE WHEN a.jumlah_pak > 0 THEN CAST((b.jumlah_pak/a.jumlah_pak) * 100 AS DECIMAL(10,2)) ELSE 0 END =30 THEN 2 
                        ELSE 3 END bobot_bop_pak
                        FROM (
                        SELECT kd_desa, SUM(anggaran) jumlah, SUM(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci
                        WHERE  kd_rincian LIKE '5%'
                        GROUP BY kd_desa
                        ) a
                        LEFT JOIN (
                        SELECT kd_desa,SUM(anggaran) jumlah, SUM(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci
                        WHERE kd_rincian LIKE '5%'
                        AND  replace(kd_keg,kd_desa,'')  IN ('01.01.01.','01.01.02.','01.01.05.','01.01.06.')
                        GROUP BY kd_desa
                        ) b ON a.kd_desa=b.kd_desa
                        LEFT JOIN (
                        SELECT kd_desa,SUM(anggaran) jumlah, SUM(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci
                        WHERE kd_rincian LIKE '5%'
                        AND  replace(kd_keg,kd_desa,'') not IN ('01.01.01.','01.01.02.','01.01.05.','01.01.06.')
                        GROUP BY kd_desa
                        ) c ON a.kd_desa=c.kd_desa"); */

        /*    DB::statement("CREATE VIEW [dbo].[panjarFisikDanaDesa] as
        SELECT a.kd_desa,nama_desa,e.kd_kec,e.nama_kecamatan,a.no_spp,a.kd_keg,nama_kegiatan,SUM(a.nilai) panjar,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu,(SUM(a.nilai) *100) / case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END persentase
        FROM ta_spprinci a
        JOIN ta_spp b ON  a.kd_desa=b.kd_desa AND a.no_spp=b.no_spp
        JOIN ta_kegiatan c ON c.kd_keg=a.kd_keg
        JOIN ref_desa d ON d.kd_desa=a.kd_desa
        JOIN Ref_Kecamatan e ON e.kd_kec=d.kd_kec
        WHERE a.sumberdana='DDS'  AND jn_spp='UM' and REPLACE(a.kd_keg,a.kd_desa,'') LIKE '02.03%'
        GROUP BY a.kd_desa,nama_desa,e.kd_kec,e.nama_kecamatan,a.kd_keg,a.no_spp,nama_kegiatan,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END
        ");
        DB::statement("CREATE VIEW [dbo].[penetapan_anggaran] as
        SELECT distinct tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,dbo.TglPenetapanAnggaran(tahun,a.kd_desa,1) usulan,dbo.keteranganpenetapan(MONTH(dbo.TglPenetapanAnggaran(tahun,a.kd_desa,1))) ket_usulan
        ,dbo.TglPenetapanAnggaran(tahun,a.kd_desa,2) anggaran_awal,dbo.keteranganpenetapan(MONTH(dbo.TglPenetapanAnggaran(tahun,a.kd_desa,2))) ket_ang
        ,dbo.TglPenetapanAnggaran(tahun,a.kd_desa,3) anggaran_pak,dbo.keteranganpenetapan(MONTH(dbo.TglPenetapanAnggaran(tahun,a.kd_desa,3))) ket_ang_pak
        ,dbo.TglPenetapanAnggaran(tahun,a.kd_desa,4) perkades,dbo.keteranganpenetapan(MONTH(dbo.TglPenetapanAnggaran(tahun,a.kd_desa,4))) ket_perkades
        FROM ta_anggaranlog a
        JOIN ref_desa b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan c ON c.Kd_Kec=b.Kd_Kec
        ");
        DB::statement("CREATE VIEW [dbo].[proyeksi_bop] AS
        SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,
        dbo.tigaPuluhPersenAng(tahun,a.kd_desa,'0') max_anggaran_awal,dbo.bopDesa(tahun,a.kd_desa,'0') bop_awal,
        dbo.tigaPuluhPersenAng(tahun,a.kd_desa,'1') max_anggaran_pak,dbo.bopDesa(tahun,a.kd_desa,'1') bop_pak
        FROM (SELECT DISTINCT tahun,kd_desa
        FROM ta_anggaran) a
        join ref_desa b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan c ON c.Kd_Kec=b.Kd_Kec
        ");
        DB::statement("CREATE VIEW [dbo].[setor_pajak] as
        SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,
        SUM(kredit) potongan ,SUM(debet) setor,  SUM(kredit)-SUM(debet) saldo, ((SUM(kredit)-SUM(debet))  /SUM(kredit)) * 100 persentase
        FROM [dbo].[QrSP_Jurnal] a
        join ref_desa b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan c ON c.Kd_Kec=b.Kd_Kec
        WHERE kd_rincian IN ('7.1.1.01.','7.1.1.02.','7.1.1.03.') 
        GROUP BY tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan
        ");
        DB::statement("CREATE VIEW [dbo].[upah_modal_konstruksi] as
        SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,
        dbo.getTotalModalFisik(tahun,a.kd_desa,'0') total_awal,dbo.upahPekerjaKonstruksi(tahun,a.kd_desa,'0') upah_awal,
        dbo.getTotalModalFisik(tahun,a.kd_desa,'1') total_pak,dbo.upahPekerjaKonstruksi(tahun,a.kd_desa,'1') upah_pak
        FROM 
        (SELECT DISTINCT tahun,kd_desa from ta_rabrinci) a
        join ref_desa b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan c ON c.Kd_Kec=b.Kd_Kec
        "); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        

        // DB::statement("DROP VIEW [dbo].[bobot_bop]");

        /*  DB::statement("DROP VIEW [dbo].[panjarFisikDanaDesa]");
        DB::statement("DROP VIEW [dbo].[penetapan_anggaran]");
        DB::statement("DROP VIEW [dbo].[proyeksi_bop]");
        DB::statement("DROP VIEW [dbo].[setor_pajak]");
        DB::statement("DROP VIEW [dbo].[upah_modal_konstruksi]"); */
    }
}
