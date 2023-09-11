<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
// use DB;

class CreateDataRefView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tahun=config('app.tahun');
        $db = config('app.ref_db').$tahun;
        DB::statement("create view ref_kecamatan".$tahun." as select * from ". $db .".dbo.ref_kecamatan");
        DB::statement("create view ref_desa".$tahun." as select * from ". $db .".dbo.ref_desa");
        DB::statement("create view ta_anggaran".$tahun." as select * from ". $db .".dbo.ta_anggaran");
        DB::statement("create view ta_anggaranlog".$tahun." as select * from ". $db .".dbo.ta_anggaranlog");
        DB::statement("create view ta_anggaranrinci".$tahun." as select * from ". $db .".dbo.ta_anggaranrinci");
        DB::statement("create view ta_kegiatan".$tahun." as select * from ". $db .".dbo.ta_kegiatan");
        DB::statement("create view ta_rab".$tahun." as select * from ". $db .".dbo.ta_rab");
        DB::statement("create view ta_rabrinci".$tahun." as select * from ". $db .".dbo.ta_rabrinci");
        DB::statement("create view ta_spp".$tahun." as select * from ". $db .".dbo.ta_spp");
        DB::statement("create view ta_spprinci".$tahun." as select * from ". $db .".dbo.ta_spprinci");
        DB::statement("create view QrSP_Jurnal".$tahun." as select * from ". $db .".dbo.QrSP_Jurnal");
        DB::statement("create view Ref_Rek2".$tahun." as select * from ". $db .".dbo.Ref_Rek2");
        DB::statement("create view ref_rek4".$tahun." as select * from ". $db .".dbo.ref_rek4");
        DB::statement("create view ref_rek3".$tahun." as select * from ". $db .".dbo.ref_rek3");
        DB::statement("create view ref_rek1".$tahun." as select * from ". $db .".dbo.ref_rek1");
        DB::statement("create view ref_potongan".$tahun." as select * from ". $db .".dbo.ref_potongan");
        DB::statement("create view Ta_SPPPot".$tahun." as select * from ". $db .".dbo.Ta_SPPPot");
        DB::statement("create view Ta_Pencairan".$tahun." as select * from ". $db .".dbo.Ta_Pencairan");
        DB::statement("create view Ta_Pajak".$tahun." as select * from ". $db .".dbo.Ta_Pajak");
        DB::statement("create view Ta_PajakRinci".$tahun." as select * from ". $db .".dbo.Ta_PajakRinci");
        DB::statement("create view ref_bel_operasional".$tahun." as select * from ". $db .".dbo.ref_bel_operasional");
        DB::statement("create view ta_sppbukti".$tahun." as select * from ". $db .".dbo.ta_sppbukti");
        DB::statement("create view Ta_SPJBukti".$tahun." as select * from ". $db .".dbo.Ta_SPJBukti");
        DB::statement("create view Ta_SaldoAwal".$tahun." as select * from ". $db .".dbo.Ta_SaldoAwal");
        DB::statement("create view ta_mutasi".$tahun." as select * from ". $db .".dbo.ta_mutasi");
        DB::statement("create view Ta_TBP".$tahun." as select * from ". $db .".dbo.Ta_TBP");
        DB::statement("create view Ta_TBPRinci".$tahun." as select * from ". $db .".dbo.Ta_TBPRinci");
        DB::statement("create view Ta_JurnalUmum".$tahun." as select * from ". $db .".dbo.Ta_JurnalUmum");
        DB::statement("create view Ta_JurnalUmumRinci".$tahun." as select * from ". $db .".dbo.Ta_JurnalUmumRinci");
        DB::statement("create view Ta_STS".$tahun." as select * from ". $db .".dbo.Ta_STS");
        DB::statement("create view Ta_STSRinci".$tahun." as select * from ". $db .".dbo.Ta_STSRinci");
        DB::statement("create view Ta_SPJSisa".$tahun." as select * from ". $db .".dbo.Ta_SPJSisa");
        DB::statement("create view Ta_SPJPot".$tahun." as select * from ". $db .".dbo.Ta_SPJPot");
        /*  DB::statement("CREATE VIEW ref_bel_operasional as SELECT * FROM ". $db .".dbo.ref_bel_operasional");
        DB::statement("CREATE VIEW ref_kecamatan AS SELECT * FROM ". $db .".dbo.ref_kecamatan");
        DB::statement("CREATE VIEW ref_desa AS SELECT * FROM ". $db .".dbo.ref_desa");
        DB::statement("CREATE VIEW ref_potongan AS SELECT * FROM ". $db .".dbo.ref_potongan");
        DB::statement("CREATE VIEW Ref_Rek1 AS SELECT * FROM ". $db .".dbo.Ref_Rek1");
        DB::statement("CREATE VIEW Ref_Rek2 AS SELECT * FROM ". $db .".dbo.Ref_Rek2");
        DB::statement("CREATE VIEW Ref_Rek3 AS SELECT * FROM ". $db .".dbo.Ref_Rek3");
        DB::statement("CREATE VIEW Ref_Rek4 AS SELECT * FROM ". $db .".dbo.Ref_Rek4");
        DB::statement("CREATE VIEW ta_anggaran AS SELECT * FROM ". $db .".dbo.ta_anggaran");
        DB::statement("CREATE VIEW ta_anggaranlog AS SELECT * FROM ". $db .".dbo.ta_anggaranlog");
        DB::statement("CREATE VIEW ta_anggaranrinci AS SELECT * FROM ". $db .".dbo.ta_anggaranrinci");
        DB::statement("CREATE VIEW ta_kegiatan AS SELECT * FROM ". $db .".dbo.ta_kegiatan");
        DB::statement("CREATE VIEW ta_pajak AS SELECT * FROM ". $db .".dbo.ta_pajak");
        DB::statement("CREATE VIEW ta_pajakrinci AS SELECT * FROM ". $db .".dbo.ta_pajakrinci");
        DB::statement("CREATE VIEW ta_rab AS SELECT * FROM ". $db .".dbo.ta_rab");
        DB::statement("CREATE VIEW ta_rabrinci AS SELECT * FROM ". $db .".dbo.ta_rabrinci");
        DB::statement("CREATE VIEW ta_pencairan AS SELECT * FROM ". $db .".dbo.ta_pencairan");
        //DB::statement("CREATE VIEW ta_rab AS SELECT * FROM ". $db .".dbo.ta_rab");
        // DB::statement("CREATE VIEW ta_rabrinci AS SELECT * FROM ". $db .".dbo.ta_rabrinci");
         DB::statement("CREATE VIEW ta_spp AS SELECT * FROM ". $db .".dbo.ta_spp");
        DB::statement("CREATE VIEW ta_spppot AS SELECT * FROM ". $db .".dbo.ta_spppot");
        DB::statement("CREATE VIEW ta_spprinci AS SELECT * FROM ". $db .".dbo.ta_spprinci");
        DB::statement("CREATE VIEW QrSP_Jurnal AS SELECT * FROM ". $db .".dbo.QrSP_Jurnal"); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $tahun=config('app.tahun');
        $db = config('app.ref_db').$tahun;
        DB::statement("DROP VIEW  ref_kecamatan".$tahun);
        DB::statement("DROP VIEW  ref_desa".$tahun);
        DB::statement("DROP VIEW  ta_anggaran".$tahun);
        DB::statement("DROP VIEW  ta_anggaranlog".$tahun);
        DB::statement("DROP VIEW  ta_anggaranrinci".$tahun);
        DB::statement("DROP VIEW  ta_kegiatan".$tahun);
        DB::statement("DROP VIEW  ta_rab".$tahun);
        DB::statement("DROP VIEW  ta_rabrinci".$tahun);
        DB::statement("DROP VIEW  ta_spp".$tahun);
        DB::statement("DROP VIEW  ta_spprinci".$tahun);
        DB::statement("DROP VIEW  QrSP_Jurnal".$tahun);
        DB::statement("DROP VIEW  Ref_Rek2".$tahun);
        DB::statement("DROP VIEW  ref_rek4".$tahun);
        DB::statement("DROP VIEW  ref_rek3".$tahun);
        DB::statement("DROP VIEW  ref_rek1".$tahun);
        DB::statement("DROP VIEW  ref_potongan".$tahun);
        DB::statement("DROP VIEW  Ta_SPPPot".$tahun);
        DB::statement("DROP VIEW  Ta_Pencairan".$tahun);
        DB::statement("DROP VIEW  Ta_Pajak".$tahun);
        DB::statement("DROP VIEW  Ta_PajakRinci".$tahun);
        DB::statement("DROP VIEW  ref_bel_operasional".$tahun);
        DB::statement("DROP VIEW  ta_sppbukti".$tahun);
        DB::statement("DROP VIEW  Ta_SPJBukti".$tahun);
        DB::statement("DROP VIEW  Ta_SaldoAwal".$tahun);
        DB::statement("DROP VIEW  ta_mutasi".$tahun);
        DB::statement("DROP VIEW  Ta_TBP".$tahun);
        DB::statement("DROP VIEW  Ta_TBPRinci".$tahun);
        DB::statement("DROP VIEW  Ta_JurnalUmum".$tahun);
        DB::statement("DROP VIEW  Ta_JurnalUmumRinci".$tahun);
        DB::statement("DROP VIEW  Ta_STS".$tahun);
        DB::statement("DROP VIEW  Ta_STSRinci".$tahun);
        DB::statement("DROP VIEW  Ta_SPJSisa".$tahun);
        DB::statement("DROP VIEW  Ta_SPJPot".$tahun);


        /*  DB::statement("DROP VIEW ref_bel_operasional");
        DB::statement("DROP VIEW ref_kecamatan");
        DB::statement("DROP VIEW ref_desa");
        DB::statement("DROP VIEW ref_potongan");
        DB::statement("DROP VIEW Ref_Rek1");
        DB::statement("DROP VIEW Ref_Rek2");
        DB::statement("DROP VIEW Ref_Rek3");
        DB::statement("DROP VIEW Ref_Rek4");
        DB::statement("DROP VIEW ta_anggaran");
        DB::statement("DROP VIEW ta_anggaranlog");
        DB::statement("DROP VIEW ta_anggaranrinci");
        DB::statement("DROP VIEW ta_kegiatan");
        DB::statement("DROP VIEW ta_pajak");
        DB::statement("DROP VIEW ta_pajakrinci");
        DB::statement("DROP VIEW ta_rab");
        DB::statement("DROP VIEW ta_rabrinci");
        DB::statement("DROP VIEW ta_pencairan");
        DB::statement("DROP VIEW ta_rab");
        DB::statement("DROP VIEW ta_rabrinci");
        DB::statement("DROP VIEW ta_spp");
        DB::statement("DROP VIEW ta_spppot");
        DB::statement("DROP VIEW ta_spprinci");
        DB::statement("DROP VIEW QrSP_Jurnal"); */
    }
}
