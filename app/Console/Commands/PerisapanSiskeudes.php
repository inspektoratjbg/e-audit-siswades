<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PerisapanSiskeudes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 
     php artisan persiapan:siskeudes --tahun=2022 --db=siskeudes.database2022
     */
    protected $signature = 'persiapan:siskeudes {--tahun=} {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tahun = $this->option('tahun') ?? '';
        $db = $this->option('db') ?? '';
        $user = env('DB_DATABASE', 'sa');
        if ($tahun <> '' && $db <> '') {

            /* $tahun = config('app.tahun');
            $db = config('app.ref_db') . $tahun; */

            // DB::beginTransaction();
            try {
                //code...
                // IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[generate_faktor_resiko2022]') )

                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_kecamatan" . $tahun . "]'))
                                drop view ref_kecamatan" . $tahun);
                DB::statement("create view ref_kecamatan" . $tahun . " as select * from " . $db . ".dbo.ref_kecamatan");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_desa" . $tahun . "]'))
                                drop view ref_desa" . $tahun);
                DB::statement("create view ref_desa" . $tahun . " as select * from " . $db . ".dbo.ref_desa");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_anggaran" . $tahun . "]'))
                                drop view ta_anggaran" . $tahun);
                DB::statement("create view ta_anggaran" . $tahun . " as select * from " . $db . ".dbo.ta_anggaran");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_anggaranlog" . $tahun . "]'))
                                drop view ta_anggaranlog" . $tahun);
                DB::statement("create view ta_anggaranlog" . $tahun . " as select * from " . $db . ".dbo.ta_anggaranlog");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_anggaranrinci" . $tahun . "]'))
                                drop view ta_anggaranrinci" . $tahun);
                DB::statement("create view ta_anggaranrinci" . $tahun . " as select * from " . $db . ".dbo.ta_anggaranrinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_kegiatan" . $tahun . "]'))
                                drop view ta_kegiatan" . $tahun);
                DB::statement("create view ta_kegiatan" . $tahun . " as select * from " . $db . ".dbo.ta_kegiatan");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_rab" . $tahun . "]'))
                                drop view ta_rab" . $tahun);
                DB::statement("create view ta_rab" . $tahun . " as select * from " . $db . ".dbo.ta_rab");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_rabrinci" . $tahun . "]'))
                                drop view ta_rabrinci" . $tahun);
                DB::statement("create view ta_rabrinci" . $tahun . " as select * from " . $db . ".dbo.ta_rabrinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_spp" . $tahun . "]'))
                                drop view ta_spp" . $tahun);
                DB::statement("create view ta_spp" . $tahun . " as select * from " . $db . ".dbo.ta_spp");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_spprinci" . $tahun . "]'))
                                drop view ta_spprinci" . $tahun);
                DB::statement("create view ta_spprinci" . $tahun . " as select * from " . $db . ".dbo.ta_spprinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[QrSP_Jurnal" . $tahun . "]'))
                                drop view QrSP_Jurnal" . $tahun);
                DB::statement("create view QrSP_Jurnal" . $tahun . " as select * from " . $db . ".dbo.QrSP_Jurnal");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ref_Rek2" . $tahun . "]'))
                                drop view Ref_Rek2" . $tahun);
                DB::statement("create view Ref_Rek2" . $tahun . " as select * from " . $db . ".dbo.Ref_Rek2");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_rek4" . $tahun . "]'))
                                drop view ref_rek4" . $tahun);
                DB::statement("create view ref_rek4" . $tahun . " as select * from " . $db . ".dbo.ref_rek4");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_rek3" . $tahun . "]'))
                                drop view ref_rek3" . $tahun);
                DB::statement("create view ref_rek3" . $tahun . " as select * from " . $db . ".dbo.ref_rek3");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_rek1" . $tahun . "]'))
                                drop view ref_rek1" . $tahun);
                DB::statement("create view ref_rek1" . $tahun . " as select * from " . $db . ".dbo.ref_rek1");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_potongan" . $tahun . "]'))
                                drop view ref_potongan" . $tahun);
                DB::statement("create view ref_potongan" . $tahun . " as select * from " . $db . ".dbo.ref_potongan");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_SPPPot" . $tahun . "]'))
                                drop view Ta_SPPPot" . $tahun);
                DB::statement("create view Ta_SPPPot" . $tahun . " as select * from " . $db . ".dbo.Ta_SPPPot");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_Pencairan" . $tahun . "]'))
                                drop view Ta_Pencairan" . $tahun);
                DB::statement("create view Ta_Pencairan" . $tahun . " as select * from " . $db . ".dbo.Ta_Pencairan");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_Pajak" . $tahun . "]'))
                                drop view Ta_Pajak" . $tahun);
                DB::statement("create view Ta_Pajak" . $tahun . " as select * from " . $db . ".dbo.Ta_Pajak");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_PajakRinci" . $tahun . "]'))
                                drop view Ta_PajakRinci" . $tahun);
                DB::statement("create view Ta_PajakRinci" . $tahun . " as select * from " . $db . ".dbo.Ta_PajakRinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ref_bel_operasional" . $tahun . "]'))
                                drop view ref_bel_operasional" . $tahun);
                DB::statement("create view ref_bel_operasional" . $tahun . " as select * from " . $db . ".dbo.ref_bel_operasional");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_sppbukti" . $tahun . "]'))
                                drop view ta_sppbukti" . $tahun);
                DB::statement("create view ta_sppbukti" . $tahun . " as select * from " . $db . ".dbo.ta_sppbukti");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_SPJBukti" . $tahun . "]'))
                                drop view Ta_SPJBukti" . $tahun);
                DB::statement("create view Ta_SPJBukti" . $tahun . " as select * from " . $db . ".dbo.Ta_SPJBukti");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_SaldoAwal" . $tahun . "]'))
                                drop view Ta_SaldoAwal" . $tahun);
                DB::statement("create view Ta_SaldoAwal" . $tahun . " as select * from " . $db . ".dbo.Ta_SaldoAwal");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[ta_mutasi" . $tahun . "]'))
                                drop view ta_mutasi" . $tahun);
                DB::statement("create view ta_mutasi" . $tahun . " as select * from " . $db . ".dbo.ta_mutasi");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_TBP" . $tahun . "]'))
                                drop view Ta_TBP" . $tahun);
                DB::statement("create view Ta_TBP" . $tahun . " as select * from " . $db . ".dbo.Ta_TBP");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_TBPRinci" . $tahun . "]'))
                                drop view Ta_TBPRinci" . $tahun);
                DB::statement("create view Ta_TBPRinci" . $tahun . " as select * from " . $db . ".dbo.Ta_TBPRinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_JurnalUmum" . $tahun . "]'))
                                drop view Ta_JurnalUmum" . $tahun);
                DB::statement("create view Ta_JurnalUmum" . $tahun . " as select * from " . $db . ".dbo.Ta_JurnalUmum");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_JurnalUmumRinci" . $tahun . "]'))
                                drop view Ta_JurnalUmumRinci" . $tahun);
                DB::statement("create view Ta_JurnalUmumRinci" . $tahun . " as select * from " . $db . ".dbo.Ta_JurnalUmumRinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_STS" . $tahun . "]'))
                                drop view Ta_STS" . $tahun);
                DB::statement("create view Ta_STS" . $tahun . " as select * from " . $db . ".dbo.Ta_STS");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_STSRinci" . $tahun . "]'))
                                drop view Ta_STSRinci" . $tahun);
                DB::statement("create view Ta_STSRinci" . $tahun . " as select * from " . $db . ".dbo.Ta_STSRinci");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_SPJSisa" . $tahun . "]'))
                                drop view Ta_SPJSisa" . $tahun);
                DB::statement("create view Ta_SPJSisa" . $tahun . " as select * from " . $db . ".dbo.Ta_SPJSisa");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[Ta_SPJPot" . $tahun . "]'))
                                drop view Ta_SPJPot" . $tahun);
                DB::statement("create view Ta_SPJPot" . $tahun . " as select * from " . $db . ".dbo.Ta_SPJPot");

                // table faktor resiko
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[faktor_resiko" . $tahun . "]') AND type in (N'U'))
                                DROP TABLE [dbo].[faktor_resiko" . $tahun . "]
                                "));

                DB::statement("CREATE TABLE [dbo].[faktor_resiko" . $tahun . "](
                                    [kd_desa] [nvarchar](8) NOT NULL,
                                    [nama_desa] [nvarchar](100) NULL,
                                    [v1] [int] NULL,
                                    [v2] [int] NULL,
                                    [v3] [int] NULL,
                                    [v4] [int] NULL,
                                    [v5] [int] NULL,
                                    [v6] [int] NULL,
                                    [v7] [int] NULL,
                                    [v8] [int] NULL,
                                    [total] [int] NULL,
                                    [tanggal] [datetime] NOT NULL
                                ) ON [PRIMARY]");



                // DB::statement("DROP FUNCTION [dbo].[bopDesa" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[bopDesa" . $tahun . "]') )
                                DROP function [dbo].[bopDesa" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[bopDesa" . $tahun . "](@tahun int,@desa VARCHAR(10) , @param VARCHAR)
                                    RETURNS FLOAT
                                    BEGIN
                                    DECLARE @result float
                                    IF @param=1
                                        BEGIN 
                                            SELECT @result=SUM(anggaranstlhpak)
                                            FROM ta_rab" . $tahun . "
                                            WHERE kd_desa =@desa AND tahun=@tahun
                                            AND kd_rincian LIKE '5.1.%';
                                        end
                                    else
                                        begin
                                            SELECT @result=SUM(anggaran)
                                            FROM ta_rab" . $tahun . "
                                            WHERE kd_desa =@desa AND tahun=@tahun
                                            AND kd_rincian LIKE '5.1.%';
                                        end
                                    RETURN @result;
                                    end");




                // DB::statement("DROP FUNCTION [dbo].[getTotalModalFisik" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[getTotalModalFisik" . $tahun . "]') )
                                DROP function [dbo].[getTotalModalFisik" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[getTotalModalFisik" . $tahun . "]
                                            (
                                                @tahun INT,
                                                @desa VARCHAR(10),
                                                @param varchar
                                            )
                                            RETURNS float
                                            BEGIN
                                            DECLARE @hasil FLOAT;
                                                    IF @param='1'
                                                    BEGIN
                                                    SELECT @hasil=SUM(anggaranstlhpak)
                                                    FROM ta_rabrinci" . $tahun . " a
                                                    WHERE kd_desa=@desa
                                                    AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
                                                    END 
                                                    ELSE
                                                    BEGIN
                                                    SELECT @hasil=SUM(anggaran)
                                                    FROM ta_rabrinci" . $tahun . " a
                                                    WHERE kd_desa=@desa
                                                    AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
                                                    END 
                                    
                                                    RETURN @hasil;
                                                    END");


                // DB::statement("DROP FUNCTION [dbo].[keteranganPenetapan" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[keteranganPenetapan" . $tahun . "]') )
                                DROP function [dbo].[keteranganPenetapan" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[keteranganPenetapan" . $tahun . "]  (@bulan int)
                            RETURNS varchar(20)
                            AS
                            BEGIN
                                    return (SELECT CASE WHEN @bulan=1 THEN  'Ringan' WHEN @bulan=2 THEN 'Sedang' when @bulan>2 then 'Berat' ELSE null end )
                            END");


                // DB::statement("DROP FUNCTION [dbo].[TglPenetapanAnggaran" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TglPenetapanAnggaran" . $tahun . "]') )
                                DROP function [dbo].[TglPenetapanAnggaran" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[TglPenetapanAnggaran" . $tahun . "](@thn INT,@desa VARCHAR(10),@posting INT)
                                    RETURNS  datetime
                                    AS
                                    BEGIN
                                        DECLARE @hasil datetime;
                                        SELECT @hasil=tglposting
                                        FROM ta_anggaranlog" . $tahun . "
                                        where tahun=@thn AND kd_desa=@desa
                                        AND kdposting=@posting;
                                    
                                        RETURN @hasil;
                                    END");

                // DB::statement("DROP FUNCTION [dbo].[tigaPuluhPersenAng" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[tigaPuluhPersenAng" . $tahun . "]') )
                                DROP function [dbo].[tigaPuluhPersenAng" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[tigaPuluhPersenAng" . $tahun . "]
                            (
                                @tahun  int,@desa varchar(10), @param varchar
                            )
                            RETURNS float
                            AS
                            BEGIN DECLARE @result float;
                                if @param = 1 
                                
                                    begin
                                        SELECT
                                        @result =(SUM(anggaranstlhpak) * 0.30)
                                        FROM
                                        ta_rab" . $tahun . "
                                        where
                                        kd_rincian LIKE '4%'
                                        AND kd_rincian NOT LIKE '4.2.4%'
                                        AND kd_desa = @desa
                                        and tahun = @tahun;
                                    end 
                                else 
                                    begin
                                        SELECT
                                        @result =(SUM(anggaran) * 0.30)
                                        FROM
                                        ta_rab" . $tahun . "
                                        where
                                        kd_rincian LIKE '4%'
                                        AND kd_rincian NOT LIKE '4.2.4%'
                                        AND kd_desa = @desa
                                        and tahun = @tahun;
                                    end 
                                return @result;
                                END");


                // DB::statement("DROP FUNCTION [dbo].[upahPekerjaKonstruksi" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[upahPekerjaKonstruksi" . $tahun . "]') )
                                DROP function [dbo].[upahPekerjaKonstruksi" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[upahPekerjaKonstruksi" . $tahun . "]
                            (
                                @tahun INT,
                                @desa VARCHAR(10),
                                @param varchar
                            )
                            RETURNS float
                            AS
                            BEGIN
                            DECLARE @hasil FLOAT;
                                IF @param='1'
                                BEGIN
                                    SELECT @hasil=SUM(anggaranstlhpak)
                                    FROM ta_rabrinci" . $tahun . " a
                                    WHERE kd_desa=@desa
                                    AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                                        AND kd_rincian ='5.3.5.02.';
                                END  ELSE
                                    BEGIN
                                        SELECT @hasil=SUM(anggaran)
                                        FROM ta_rabrinci" . $tahun . " a
                                        WHERE kd_desa=@desa
                                        AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                                            AND kd_rincian ='5.3.5.02.';
                                    END 
                                RETURN @hasil;
                            END
                ");

                // DB::statement("DROP FUNCTION [dbo].[v_anggaran" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_anggaran" . $tahun . "]') )
                                DROP function [dbo].[v_anggaran" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_anggaran" . $tahun . "]
                            (
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN
                            -- Declare the return variable here
                            DECLARE @bobot int;
    
                                -- Add the T-SQL statements to compute the return value here
                                    SELECT @bobot=CASE when cast(month(tglposting) AS INT)=1 THEN 1 WHEN cast(month(tglposting) AS INT)=2 THEN 2 ELSE 3 END 
                                    FROM ta_anggaranlog" . $tahun . "
                                    WHERE kd_desa=@desa
                                    AND kdposting=2;
    
                                -- Return the result of the function
                                RETURN @bobot;
                            END");



                // DB::statement("DROP FUNCTION [dbo].[v_bop" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_bop" . $tahun . "]') )
                                DROP function [dbo].[v_bop" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_bop" . $tahun . "]
                            (
                                -- Add the parameters for the function here
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN 
                            DECLARE @bobot int;
                                -- Add the T-SQL statements to compute the return value here
                                SELECT
                                @bobot =CASE
                                    WHEN case
                                    when a.jumlah is not null then CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2))
                                    else 0
                                    END < 30 THEN 1
                                    when case
                                    when a.jumlah is not null then CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2))
                                    else 0
                                    END = 30 THEN 2
                                    else 3
                                end
                                FROM
                                (
                                    SELECT
                                    LEFT(kd_rincian, 1) kode,
                                    SUM(
                                        case
                                        when anggaranstlhpak IS not null THEN anggaranstlhpak
                                        ELSE anggaran
                                        END
                                    ) jumlah
                                    FROM
                                    ta_rabrinci" . $tahun . "
                                    WHERE
                                    kd_desa = @desa
                                    AND kd_rincian LIKE '5%'
                                    GROUP BY
                                    LEFT(kd_rincian, 1)
                                ) a
                                LEFT JOIN (
                                    SELECT
                                    LEFT(kd_rincian, 1) kode,
                                    SUM(
                                        case
                                        when anggaranstlhpak IS not null THEN anggaranstlhpak
                                        ELSE anggaran
                                        END
                                    ) jumlah
                                    FROM
                                    ta_rabrinci" . $tahun . "
                                    WHERE
                                    kd_desa = @desa
                                    AND kd_rincian LIKE '5%'
                                    AND replace(kd_keg, kd_desa, '') IN (
                                        SELECT
                                        *
                                        from
                                        ref_bel_operasional" . $tahun . "
                                    )
                                    GROUP BY
                                    LEFT(kd_rincian, 1)
                                ) b ON a.kode = b.kode;
                                -- Return the result of the function
                                RETURN @bobot;
                                END");




                // DB::statement("DROP FUNCTION [dbo].[v_dumas" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_dumas" . $tahun . "]') )
                                DROP function [dbo].[v_dumas" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_dumas" . $tahun . "]
                            (
                                -- Add the parameters for the function here
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN -- Declare the return variable here
                            DECLARE @hasil int;
                                select
                                @hasil = jumlah
                                from
                                pengaduan_masyarakat
                                where
                                kd_desa = @desa and tahun='" . $tahun . "';
    
                                IF @@ROWCOUNT = 0 
                                begin
                                    set     @hasil = 0;
                                end 
                            return @hasil;
                            END
                ");


                // DB::statement("DROP FUNCTION [dbo].[v_fisik" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_fisik" . $tahun . "]') )
                                DROP function [dbo].[v_fisik" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_fisik" . $tahun . "]
                            (
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN -- Declare the return variable here
                            DECLARE @bobot int;
                            -- Add the T-SQL statements to compute the return value here
                            SELECT
                            @bobot =CASE
                                WHEN cast(
                                b.jumlah / NULLIF(a.jumlah, 0) * 100 AS DECIMAL(10, 2)
                                ) < 15 THEN 1
                                WHEN cast(
                                b.jumlah / NULLIF(a.jumlah, 0) * 100 AS DECIMAL(10, 2)
                                ) >= 15
                                AND cast(
                                b.jumlah / NULLIF(a.jumlah, 0) * 100 AS DECIMAL(10, 2)
                                ) <= 20 THEN 2
                                else 3
                            END
                            FROM
                            (
                                SELECT
                                akun,
                                nama_akun,
                                SUM(
                                    case
                                    when anggaranstlhpak IS not null THEN anggaranstlhpak
                                    ELSE anggaran
                                    END
                                ) jumlah
                                FROM
                                ta_rabrinci" . $tahun . " a
                                JOIN ref_rek1" . $tahun . " b ON left(a.kd_rincian, 2) = b.akun
                                WHERE
                                kd_desa = @desa
                                AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                                GROUP BY
                                akun,
                                nama_akun
                            ) a
                            LEFT JOIN (
                                SELECT
                                akun,
                                nama_akun,
                                SUM(
                                    case
                                    when anggaranstlhpak IS not null THEN anggaranstlhpak
                                    ELSE anggaran
                                    END
                                ) jumlah
                                FROM
                                ta_rabrinci" . $tahun . " a
                                JOIN ref_rek1" . $tahun . " b ON left(a.kd_rincian, 2) = b.akun
                                WHERE
                                kd_desa = @desa
                                AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                                AND kd_rincian LIKE '%02.'
                                GROUP BY
                                akun,
                                nama_akun
                            ) b ON a.akun = b.akun;
                            -- Return the result of the function
                            return @bobot;
                            END
    
                        ");

                // DB::statement("DROP FUNCTION [dbo].[v_pajak" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_pajak" . $tahun . "]') )
                                DROP function [dbo].[v_pajak" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_pajak" . $tahun . "]
                            (
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN -- Declare the return variable here
                            DECLARE @bobot int,
                            @persen float;
                            -- Add the T-SQL statements to compute the return value here
                           SELECT @persen=CAST( (SUM(potongan) - SUM(setor)) / NULLIF(SUM(potongan),0) * 100 AS DECIMAL(10, 2) )
                            FROM
                            (
                                SELECT B.Kd_Rincian, Sum(B.Nilai) AS potongan, Sum(0) AS setor
                                FROM Ta_Pencairan" . $tahun . " AS A
                                INNER JOIN Ta_SPPPot" . $tahun . " AS B ON A.No_SPP = B.No_SPP
                                WHERE a.kd_desa=@desa
                                AND kd_rincian IN (
                                    SELECT kd_Potongan FROM ref_potongan" . $tahun . "
                                )
                                GROUP BY
                                B.Kd_Rincian
                                UNION
                                SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                              FROM Ta_Pajak" . $tahun . " AS A
                                INNER JOIN Ta_PajakRinci" . $tahun . " AS B ON A.No_SSP = B.No_SSP
                                WHERE a.kd_desa=@desa
                                AND a.kd_rincian IN (
                                    SELECT kd_Potongan FROM ref_potongan" . $tahun . "
                                )
                                GROUP BY
                                B.Kd_Rincian
                            ) a;
                            --	Kurang dari 10 % = 1 (Ringan)
                            --	Diantara 10 - 20 % = 2 (Sedang)
                            --	Lebih dari 20 % = 3 (Berat)
                            if @persen < 10 
                                begin
                                    set    @bobot = 1;
                                end
                            else 
                                begin 
                                    if @persen >= 10 and @persen <= 20 
                                        begin
                                        set @bobot=2;
                                    end
                                    else 
                                        begin
                                            set @bobot=3;
                                        end
                                    end -- Return the result of the function
                                return @bobot;
                            END
                    ");




                // DB::statement("DROP FUNCTION [dbo].[v_panjar" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_panjar" . $tahun . "]') )
                                DROP function [dbo].[v_panjar" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_panjar" . $tahun . "]
                            (
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN 
                            declare @pagu float, @panjar float, @persen float, @bobot int;
                            set
                            @pagu =(
                                SELECT SUM(pagu)
                                FROM
                                (
                                    SELECT distinct a.kd_keg,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu
                                    FROM TA_SPPRINCI" . $tahun . " A
                                    JOIN TA_SPP" . $tahun . " B ON A.KD_DESA = B.KD_DESA
                                    AND A.NO_SPP = B.NO_SPP
                                    JOIN TA_KEGIATAN" . $tahun . " C ON C.KD_KEG = A.KD_KEG
                                    WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                                ) pagu
                            );
                            
                            set @panjar=(
                                SELECT SUM(a.nilai) panjar
                                FROM TA_SPPRINCI" . $tahun . " A
                                JOIN TA_SPP" . $tahun . " B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                                JOIN TA_KEGIATAN" . $tahun . " C ON C.KD_KEG = A.KD_KEG
                                WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                            );
    
                            if @panjar > 0 
                                begin
                                    SET @persen=cast(@panjar / nullif(@pagu,0) * 100 as decimal(10, 2));
                                end
                            else 
                                begin
                                    set @persen=0;
                                end
                            
                            if @persen < 10 
                                begin
                                    set @bobot=1;
                                 end
                            else
                            begin 
                                IF @persen >=10 and @persen <=30 
                                    begin
                                        set @bobot=2;
                                    END
                                else 
                                    begin
                                     set @bobot=3;
                                    end
                            end 
                            
                            return @bobot;
                        END");


                // DB::statement("DROP FUNCTION [dbo].[v_pembKeuangan" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_pembKeuangan" . $tahun . "]') )
                                DROP function [dbo].[v_pembKeuangan" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION [dbo].[v_pembKeuangan" . $tahun . "]
                            (
                                -- Add the parameters for the function here
                                @desa nvarchar(10)
                            )
                            RETURNS int
                            AS
                            BEGIN
                                -- Declare the return variable here
                            DECLARE @hasil int;
    
                                select @hasil=jumlah
                            from pembinaan_keuangan
                            where kd_desa=@desa and tahun='" . $tahun . "';
                                IF @@ROWCOUNT = 0
                                    begin
                                        set @hasil = 0;
                                    end
                                    return @hasil;
                            END
                            ");

                // DB::statement("DROP FUNCTION [dbo].[v_pengKeuangan" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[v_pengKeuangan" . $tahun . "]') )
                                DROP function [dbo].[v_pengKeuangan" . $tahun . "]
                                "));
                DB::statement("CREATE FUNCTION v_pengKeuangan" . $tahun . "
                                (
                                    @desa nvarchar(10)        
                                )
                                RETURNS int
                                as
                                BEGIN
                                    -- Declare the return variable here
                                    DECLARE @hasil int;
                                    select @hasil=jumlah
                                    from pengawasan_keuangan
                                    where kd_desa=@desa and tahun='" . $tahun . "';
                                    IF @@ROWCOUNT = 0
                                        begin
                                            set @hasil = 0;
                                        end        
                                    return @hasil;
                                END");

                // finish function

                // ###############################   awal procedure ############

                DB::statement("DROP PROCEDURE [dbo].[sp_upah_pekerja" . $tahun . "]");
                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[sp_upah_pekerjan" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[sp_upah_pekerjan" . $tahun . "]
                                ")); */
                DB::statement("CREATE PROCEDURE [dbo].[sp_upah_pekerja" . $tahun . "] @desa nvarchar(10)
                    AS
                    BEGIN
                        SELECT a.jenis, a.nama_jenis, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                        FROM
                        (
                            SELECT b.jenis, nama_jenis, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                            FROM ta_rabrinci" . $tahun . " a
                            JOIN ref_rek3" . $tahun . " b ON left(a.kd_rincian, 6) = b.jenis
                            WHERE kd_desa='01.2001.' AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                            GROUP BY b.jenis, nama_jenis
                        ) a
                        LEFT JOIN (
                            SELECT b.jenis, nama_jenis, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                            FROM ta_rabrinci" . $tahun . " a
                            JOIN ref_rek3" . $tahun . " b ON left(a.kd_rincian, 6) = b.jenis
                           WHERE kd_desa='01.2001.' AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                            GROUP BY b.jenis, nama_jenis
                        ) b ON a.jenis = b.jenis
                        union
                        SELECT NULL akun, 'Jumlah' nama_akun, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                        FROM
                        (
                            SELECT akun, nama_akun, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                            FROM ta_rabrinci" . $tahun . " a
                            JOIN ref_rek1" . $tahun . " b ON left(a.kd_rincian, 2) = b.akun
                            WHERE kd_desa=@desa AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                           GROUP BY akun, nama_akun
                        ) a
                        LEFT JOIN (
                            SELECT akun, nama_akun, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                            FROM ta_rabrinci" . $tahun . " a
                            JOIN ref_rek1" . $tahun . " b ON left(a.kd_rincian, 2) = b.akun
                            WHERE kd_desa=@desa AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                            GROUP BY akun, nama_akun
                        ) b ON a.akun = b.akun
                        END");


                DB::statement("DROP PROCEDURE [dbo].[sp_total_panjar" . $tahun . "]");
                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[sp_total_panjar" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[sp_total_panjar" . $tahun . "]
                                ")); */
                DB::statement("CREATE PROCEDURE [dbo].[sp_total_panjar" . $tahun . "] @desa nvarchar(10) AS
                    BEGIN 
                    declare @pagu float, @panjar float, @persen float;
                    set @pagu=(
                            SELECT SUM(pagu)
                                FROM
                                (
                                    SELECT distinct a.kd_keg,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu
                                FROM TA_SPPRINCI" . $tahun . " A
                                    JOIN TA_SPP" . $tahun . " B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                                    JOIN TA_KEGIATAN" . $tahun . " C ON C.KD_KEG = A.KD_KEG
                                WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                                ) pagu
                            );
    
    
                    set @panjar=(
                        SELECT SUM(a.nilai) panjar
                       FROM TA_SPPRINCI" . $tahun . " A
                       JOIN TA_SPP" . $tahun . " B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                        JOIN TA_KEGIATAN" . $tahun . " C ON C.KD_KEG = A.KD_KEG
                        WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                    );
    
                    if @panjar > 0 begin
                        SET @persen=cast(@panjar / nullif(@pagu,0) * 100 as decimal(10, 2));
                    end
                    else begin
                        set @persen=null
                    end
                    select @pagu pagu, @panjar panjar, @persen persen;
                END");

                DB::statement("DROP PROCEDURE [dbo].[sp_pajak" . $tahun . "]");
                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[sp_pajak" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[sp_pajak" . $tahun . "]
                                ")); */
                DB::statement("CREATE PROCEDURE [dbo].[sp_pajak" . $tahun . "] @desa nvarchar(10) AS
                    BEGIN
                    SELECT '1' sc, kd_rincian kode, nama_obyek uraian, SUM(potongan) potongan, SUM(setor) setor, SUM(potongan) - SUM(setor) saldo, CAST( (SUM(potongan) - SUM(setor)) / NULLIF(SUM(potongan),0) * 100 AS DECIMAL(10, 2) ) persen
                    FROM
                    (
                    SELECT B.Kd_Rincian, Sum(B.Nilai) AS potongan, Sum(0) AS setor
                        FROM Ta_Pencairan" . $tahun . " AS A
                        INNER JOIN Ta_SPPPot" . $tahun . " AS B ON A.No_SPP = B.No_SPP
                    WHERE a.kd_desa=@desa AND kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan" . $tahun . " )
                    GROUP BY B.Kd_Rincian
                        UNION
                        SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                        FROM Ta_Pajak" . $tahun . " AS A
                        INNER JOIN Ta_PajakRinci" . $tahun . " AS B ON A.No_SSP = B.No_SSP
                    WHERE a.kd_desa=@desa AND a.kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan" . $tahun . " )
                        GROUP BY B.Kd_Rincian
                    ) a
                    JOIN ref_rek4" . $tahun . " b ON a.kd_rincian = b.obyek
                        GROUP BY kd_rincian, nama_obyek
                        UNION all
                        SELECT '2' sc, null kode, 'Jumlah' uraian, SUM(potongan) potongan, SUM(setor) setor, SUM(potongan) - SUM(setor) saldo, CAST( (SUM(potongan) - SUM(setor)) / NULLIF(SUM(potongan),0) * 100 AS DECIMAL(10, 2) ) persen
                        FROM
                        (
                        SELECT B.Kd_Rincian, Sum(B.Nilai) AS potongan, Sum(0) AS setor
                        FROM Ta_Pencairan" . $tahun . " AS A
                        INNER JOIN Ta_SPPPot" . $tahun . " AS B ON A.No_SPP = B.No_SPP
                        WHERE a.kd_desa=@desa AND kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan" . $tahun . " )
                        GROUP BY B.Kd_Rincian
                        UNION
                        SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                        FROM Ta_Pajak" . $tahun . " AS A
                        INNER JOIN Ta_PajakRinci" . $tahun . " AS B ON A.No_SSP = B.No_SSP
                        WHERE a.kd_desa=@desa AND a.kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan" . $tahun . " )
                        GROUP BY B.Kd_Rincian
                    ) a;
                    END");

                DB::statement("DROP PROCEDURE [dbo].[sp_komposisi_belanja" . $tahun . "]");
                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[sp_komposisi_belanja" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[getTotalModalFisik" . $tahun . "]
                                ")); */
                DB::statement("CREATE PROCEDURE [dbo].[sp_komposisi_belanja" . $tahun . "]
                                    
                                    @desa nvarchar(10),
                                    @pak int
                                AS
                                BEGIN
                                    -- SET NOCOUNT ON added to prevent extra result sets from
                                    -- interfering with SELECT statements.
                                    -- SET NOCOUNT ON;
                                
                                    -- Insert statements for procedure here
                                    -- query jadi fix
                                SELECT  a.kode,nama_kelompok jenis_belanja,a.jumlah,b.jumlah jumlah_bop, 
                                case when a.jumlah >0 then   CAST( (b.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2)) else 0 end persen_bop  ,c.jumlah jumlah_non_bop,
                                case when a.jumlah>0 then  CAST((c.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2) ) else 0 end persen_non_bop
                                FROM (
                                SELECT LEFT(kd_rincian,4) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                GROUP BY LEFT(kd_rincian,4)
                                ) a
                                LEFT JOIN (
                                SELECT LEFT(kd_rincian,4) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                AND  replace(kd_keg,kd_desa,'')  IN (SELECT * from ref_bel_operasional" . $tahun . ")
                                GROUP BY LEFT(kd_rincian,4)
                                ) b ON a.kode=b.kode
                                LEFT JOIN (
                                SELECT LEFT(kd_rincian,4) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                AND  replace(kd_keg,kd_desa,'') not IN (SELECT * from ref_bel_operasional" . $tahun . ")
                                GROUP BY LEFT(kd_rincian,4) 
                                ) c ON a.kode=c.kode
                                JOIN ref_rek2" . $tahun . " d ON d.kelompok=a.kode
                                UNION 
                                SELECT  NULL kode,'Jumlah' jeins_belanja,a.jumlah,b.jumlah jumlah_bop, case when a.jumlah is not null then   CAST( (b.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2)) else 0 end persen_bop  ,c.jumlah jumlah_non_bop,case when a.jumlah is not null then  CAST((c.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2) ) else 0 end persen_non_bop
                                FROM (
                                SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                GROUP BY LEFT(kd_rincian,1)
                                ) a
                                LEFT JOIN (
                                SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                AND  replace(kd_keg,kd_desa,'')  IN (SELECT * from ref_bel_operasional" . $tahun . ")
                                GROUP BY LEFT(kd_rincian,1)
                                ) b ON a.kode=b.kode
                                LEFT JOIN (
                                SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
                                FROM ta_rabrinci" . $tahun . "
                                WHERE kd_desa=@desa
                                AND kd_rincian LIKE '5%'
                                AND  replace(kd_keg,kd_desa,'') not IN (SELECT * from ref_bel_operasional" . $tahun . ")
                                GROUP BY LEFT(kd_rincian,1)
                                ) c ON a.kode=c.kode;
                                
                                END");



                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[generate_faktor_resiko" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[generate_faktor_resiko" . $tahun . "]
                                ")); */

                DB::statement("DROP PROCEDURE [dbo].[generate_faktor_resiko" . $tahun . "]");
                DB::statement("CREATE PROCEDURE [dbo].[generate_faktor_resiko" . $tahun . "] 
                            AS
                            BEGIN
                                DELETE FROM faktor_resiko" . $tahun . ";
                                
                                INSERT INTO [dbo].[faktor_resiko" . $tahun . "] ([kd_desa] ,[nama_desa] ,[v1] ,[v2] ,[v3] ,[v4] ,[v5] ,[v6] ,[v7] ,[v8] ,[total] ,[tanggal])
                                select kd_desa,nama_desa,v1,
                                v2,
                                v3,
                                v4,
                                v5,
                                v6,
                                v7,
                                v8,v1 + 
                                v2 + 
                                v3 + 
                                v4 + 
                                v5 + 
                                v6 + 
                                v7 + 
                                v8 total,
                                getdate() tanggal
                                from (
                                SELECT kd_desa,nama_desa
                                , cast(dbo.v_anggaran2022(kd_desa)  as int) v1
                                , cast(dbo.v_bop2022(kd_desa)  as int) v2
                                , cast(dbo.v_fisik2020(kd_desa)  as int) v3
                                 , cast(dbo.v_panjar2020(kd_desa)  as int) v4
                                , cast(dbo.v_pajak2020(kd_desa)  as int) v5
                                , cast(dbo.v_pembKeuangan2020(kd_desa)  as int) v6
                                , cast(dbo.v_pengKeuangan2020(kd_desa)  as int) v7
                                , cast(dbo.v_dumas2020(kd_desa)  as int) v8
                                FROM ref_desa" . $tahun . "
                                ) fix_table;
                            END");

                DB::statement("DROP PROCEDURE [dbo].[ringkasan_keuangan" . $tahun . "]");
                /* DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[ringkasan_keuangan" . $tahun . "]') )
                                DROP PROCEDURE [dbo].[ringkasan_keuangan" . $tahun . "]
                                ")); */
                DB::statement("CREATE PROCEDURE [dbo].[ringkasan_keuangan" . $tahun . "]
                            @desa nvarchar(10)
                        AS
                        BEGIN
                        SET NOCOUNT ON ;
                            declare @ringkasan table(label_a varchar(100),label_b varchar(100),keterangan varchar(500),nilai money);
                        
                            insert into @ringkasan
                            select 'I',null,'Register SPP dan Kuitansi',null;
                        
                            declare @spp table(keterangan varchar(100),nilai money);
                            insert into @spp
                            SELECT 'Register SPP',sum(Jumlah)
                                FROM [dbo].[Ta_SPP" . $tahun . "] 
                                WHERE Kd_Desa=@desa;
                        
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @spp;
                        
                            declare @kwitansi table(keterangan varchar(100),nilai money);
                            insert into @kwitansi
                            SELECT 'Register Kwitansi',sum(nilai) nilai from (
                                    select sum(nilai) nilai
                                        from ta_sppbukti" . $tahun . "
                                    where Kd_Desa=@desa
                                    union all
                                    select sum(nilai) from Ta_SPJBukti" . $tahun . " where Kd_Desa=@desa ) a;
                        
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @kwitansi;
                            
                            insert into @ringkasan
                            select null,'-','Selisih',(select nilai from @spp ) - (select nilai from @kwitansi);
                        
                            insert into @ringkasan
                            select 'II',null,'Pendapatan (Anggaran Pendapatan di APBDes)',null;
                        
                            declare @apad table(keterangan varchar(100),nilai money);
                            insert into @apad
                            SELECT 'Anggaran Pendapatan',case when sum(anggaranstlhpak) is not null or sum(anggaranstlhpak) !=0 then sum(anggaranstlhpak) else  sum(anggaran) end 
                                                            from ta_rab" . $tahun . "
                                                            where kd_desa=@desa
                                                            and left(Kd_Rincian,1)=4;
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @apad;
                            
                            declare @rpad table(keterangan varchar(100),nilai money);
                            insert into @rpad
                            select 'Real. Pendapatan s/d Pemeriksaan',(SUM(debet) + SUM(kredit)) FROM (
                            SELECT 12 AS Kd_Source, A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian, 'K' AS D_K, Sum(0) AS Debet, Sum(A.Nilai) AS Kredit
                            FROM Ta_Mutasi" . $tahun . " AS A
                            WHERE (((A.Kd_Mutasi)=3)) AND kd_desa=@desa
                            GROUP BY A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian  
                            UNION all
                            SELECT 2 AS Kd_Source, A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, B.Kd_Rincian, 'K' AS D_K, Sum(0) AS Debet, Sum(B.Nilai) AS Kredit
                            FROM Ta_TBP" . $tahun . " AS A INNER JOIN Ta_TBPRinci" . $tahun . " AS B ON A.No_Bukti = B.No_Bukti
                            WHERE (((A.KdBayar)=2)) AND a.kd_desa=@desa
                            GROUP BY A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, B.Kd_Rincian ) a;
                            
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @rpad;
                            
                            insert into @ringkasan
                            select null,'-','Kurang Realisasi',(select nilai from @apad ) - (select nilai from @rpad);
                            
                            insert into @ringkasan
                            select 'III',null,'Belanja (Anggaran Belanja di APBDesa)',null;
                            
                            declare @abelanja table(keterangan varchar(100),nilai money);
                            insert into @abelanja
                            SELECT 'Anggaran Belanja',case when sum(anggaranstlhpak) is not null or sum(anggaranstlhpak) !=0 then sum(anggaranstlhpak) else  sum(anggaran) end anggaran
                                                            from ta_rab" . $tahun . "
                                                            where kd_desa=@desa
                                                            and left(Kd_Rincian,1)=5;
                            
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @abelanja;
                        
                            declare @rbelanja table(keterangan varchar(100),nilai money);
                            insert into @rbelanja
                            SELECT 'Realisasi Belanja s/d Pemeriksaan',SUM(nilai) FROM (     
                            SELECT  Sum(A.Nilai) nilai
                            FROM Ta_Mutasi" . $tahun . " AS A
                            WHERE (((A.Kd_Mutasi)=4)) AND Kd_Desa=@desa AND LEFT(Kd_Rincian,1)=5
                            GROUP BY A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian
                            UNION all
                            SELECT  Sum(B.Nilai) nilai
                            FROM (Ta_SPP" . $tahun . " AS A INNER JOIN Ta_SPPRinci" . $tahun . " AS B ON A.No_SPP = B.No_SPP) INNER JOIN Ta_Pencairan" . $tahun . " AS C ON A.No_SPP = C.No_SPP
                            WHERE (((A.Jn_SPP)<>'UM')) AND a.kd_desa=@desa
                            GROUP BY A.Tahun, A.Kd_Desa, C.Tgl_Cek, A.No_SPP, B.Kd_Rincian ) a;
                            
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @rbelanja;
                        
                            insert into @ringkasan
                            select null,'-','Kurang Belanja',(select nilai from @abelanja ) - (select nilai from @rbelanja);
                            
                            
                            insert into @ringkasan
                            select 'IV',null,'Surplus/Defisit Pendapatan dan Belanja sampai dengan pemeriksaan ',null;
                            insert into @ringkasan
                            select null,'-','Realisasi Pendapatan',nilai from @rpad;
                            insert into @ringkasan
                            select null,'-','Realisasi Belanja',nilai from @rbelanja;
                            insert into @ringkasan
                            select null,'-','Surplus (berdasarkanLRA)', (select nilai from @rpad) - (select nilai from @rbelanja);
                            
                        
                            insert into @ringkasan
                            select 'V',null,'Pembiayaan',null;
                        
                            declare @silpa_tahun_lalu table(keterangan varchar(100),nilai money);
                            insert into @silpa_tahun_lalu
                            select 'Silpa tahun lalu',case when AnggaranStlhPAK is null then anggaran else AnggaranStlhPAK end 
                                from Ta_RAB" . $tahun . "
                                where Kd_Desa=@desa
                                and Kd_Rincian='6.1.1.01.';
                        
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @silpa_tahun_lalu;
                        
                            declare @penerimaan_pembiayaan table(keterangan varchar(100),nilai money);
                        
                            insert into @penerimaan_pembiayaan
                            SELECT 'Penerimaan Pembiayaan',sum(B.Debet+ B.Kredit)
                        FROM Ta_JurnalUmum" . $tahun . " AS A INNER JOIN Ta_JurnalUmumRinci" . $tahun . " AS B ON A.NoBukti = B.NoBukti
                        AND a.kd_desa=@desa AND LEFT(Kd_Rincian,3)='6.1'
                        WHERE (A.Posted=1) ;
                        
                            
                            insert into @ringkasan
                            select null,'-',keterangan,nilai from @penerimaan_pembiayaan;
                        
                            insert into @ringkasan
                            select null,null,null,(select nilai from @silpa_tahun_lalu) - (select nilai from @penerimaan_pembiayaan);
                        
                            insert into @ringkasan
                            select null,'-','Pengeluaran Pembiayaan',nilai from @penerimaan_pembiayaan;
                        
                            insert into @ringkasan
                            select null,'-','Pembiayaan Netto',((select nilai from @silpa_tahun_lalu) - (select nilai from @penerimaan_pembiayaan)) + (select nilai from @penerimaan_pembiayaan);
                        
                            insert into @ringkasan
                            select 'VI',null,'SILPA Tahun ini',null;
                            insert into @ringkasan
                            select null,'-','Surplus', (select nilai from @rpad) - (select nilai from @rbelanja);
                            insert into @ringkasan
                            select null,'-','Pembiayaan Netto',((select nilai from @silpa_tahun_lalu) - (select nilai from @penerimaan_pembiayaan)) + (select nilai from @penerimaan_pembiayaan);
                            
                            insert into @ringkasan
                            select null,'-','SILPA',(((select nilai from @silpa_tahun_lalu) - (select nilai from @penerimaan_pembiayaan)) + (select nilai from @penerimaan_pembiayaan)) + ((select nilai from @rpad) - (select nilai from @rbelanja));
                        
                            insert into @ringkasan
                            select 'VII',null,'Penutupan Buku Kas Umum per tanggal pemeriksaan',null;
                            insert into @ringkasan
                            select null,'#','Buku pembantu kas',null;
                            
                            declare @kastunai table(penerimaan money,pengeluaran money);
                        
                            insert into @kastunai
                            SELECT SUM(DEBET) PENERIMAAN ,SUM(KREDIT) PENGELUARAN
                                FROM (
                                SELECT DEBET,KREDIT
                                FROM QRSP_JURNAL" . $tahun . "
                                WHERE KD_DESA=@desa
                                AND KD_RINCIAN='1.1.1.01.'
                                UNION ALL
                                SELECT DEBET,KREDIT
                                FROM TA_SALDOAWAL" . $tahun . "
                                WHERE KD_DESA=@desa
                                AND KD_RINCIAN='1.1.1.01.'
                                ) A;
                        
                                insert into @ringkasan
                                select null,'-','Penerimaan *)',penerimaan from @kastunai;
                                insert into @ringkasan
                                select null,'-','Pengeluaran *)',pengeluaran from @kastunai;
                        
                                insert into @ringkasan
                                select null,'-','Saldo Kas Tunai',penerimaan-pengeluaran from @kastunai;
                                
                                declare @kasbank table (penerimaan money,pengeluaran money);
                                insert into @kasbank
                                SELECT SUM(DEBET) PENERIMAAN ,SUM(KREDIT) PENGELUARAN
                                from (
                                select debet,Kredit
                                from QrSP_Jurnal" . $tahun . "
                                where Kd_Desa='01.2002.'
                                and Kd_Rincian=@desa
                                union all
                                select debet,Kredit
                                from Ta_SaldoAwal" . $tahun . "
                                where Kd_Desa=@desa
                                and Kd_Rincian='1.1.1.02.'
                                ) a;
                            insert into @ringkasan
                            select null,'#','Buku pembantu Bank',null;
                            insert into @ringkasan
                                select null,'-','Penerimaan *)',penerimaan from @kasbank;
                                insert into @ringkasan
                                select null,'-','Pengeluaran *)',pengeluaran from @kasbank;
                        
                                insert into @ringkasan
                                select null,'-','Saldo Kas di Bank',penerimaan-pengeluaran from @kasbank;
                            
                            insert into @ringkasan
                            select null,'#','Buku Kas Umum ',null;
                            insert into @ringkasan
                                select null,'-','Penerimaan',(select penerimaan from @kasbank)+(select penerimaan from @kastunai);
                                insert into @ringkasan
                                select null,'-','Pengeluaran',(select pengeluaran from @kasbank)+(select pengeluaran from @kastunai);
                                insert into @ringkasan
                                select null,'-','Saldo Kas',  (select penerimaan from @kasbank)+(select penerimaan from @kastunai)  -  (select pengeluaran from @kasbank)+(select pengeluaran from @kastunai);
                                insert into @ringkasan
                                select null,'-','Saldo Kas di Bank',penerimaan-pengeluaran from @kasbank;
                                insert into @ringkasan
                                select null,'-','Saldo Kas Tunai',penerimaan-pengeluaran from @kastunai;
                        
                            insert into @ringkasan
                            select 'VIII',null,'Surat Pertanggung Jawaban ( SPJ ) (sesuai LRA)',null;
                            
                            insert into @ringkasan
                            select null,'-','Jumlah pengeluaran (LRA) ',nilai from @rbelanja;
                        
                            insert into @ringkasan
                            select null,'-','Telah dipertanggungjawabkan / SPJ (Kuitansi)',nilai from @kwitansi;
                        
                            insert into @ringkasan
                            select null,'-','Sisa yang belum di SPJ kan ',(select nilai from @rbelanja) - (select  nilai from @kwitansi);
                        
                            insert into @ringkasan
                            select 'IX',null,'Penerimaan PPN / PPh',null;
                        
                            declare @pajak table(jenis varchar(200),penerimaan money,setor money);
                            insert into @pajak
                            SELECT  CASE WHEN LEFT(kd_rincian,5)='7.1.1' THEN 'pph' ELSE 'ppd' END jenis,
                                SUM(DEBET) POTONGAN , SUM(KREDIT) SETOR
                                FROM QRSP_JURNAL" . $tahun . "
                                WHERE  KD_DESA=@desa AND LEFT(kd_rincian,5) IN ('7.1.2','7.1.1')
                                GROUP BY CASE WHEN LEFT(kd_rincian,5)='7.1.1' THEN 'pph' ELSE 'ppd' END;
                                    
                                insert into @ringkasan
                                select null,'-','Penerimaan',penerimaan from @pajak where jenis='pph';
                                insert into @ringkasan
                                select null,'-','Penyetoran',setor from @pajak where jenis='pph';
                                insert into @ringkasan
                                select null,'-','Sisa belum di setor',penerimaan - setor from @pajak where jenis='pph';
                        
                                insert into @ringkasan
                            select 'X',null,'Penerimaan Pajak Daerah',null;
                            insert into @ringkasan
                                select null,'-','Penerimaan',penerimaan from @pajak where jenis='ppd';
                                insert into @ringkasan
                                select null,'-','Penyetoran',setor from @pajak where jenis='ppd';
                                insert into @ringkasan
                                select null,'-','Sisa belum di setor',penerimaan - setor from @pajak where jenis='ppd';
                                
                            -- delete old data
                            delete [dbo].[ringkasan_keuangan_desa]
                            where kd_desa=@desa and tahun='" . $tahun . "';
                        
                            --- result
                            -- insert hasil
                            INSERT INTO [dbo].[ringkasan_keuangan_desa]
                                ([tahun],
                                    [kd_desa]
                                ,[label_a]
                                ,[label_b]
                                ,[keterangan]
                                ,[nilai]
                                ,[created_at]
                                ,[updated_at])
                            select " . $tahun . " tahun,@desa kd_desa,a.*,GETDATE() created_at,GETDATE() updated_at FROM @ringkasan a;
                        END
                        ");


                // DB::statement("DROP VIEW [dbo].[penetapan_anggaran" . $tahun . "]");
                 DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[penetapan_anggaran" . $tahun . "]') )
                                DROP view [dbo].[penetapan_anggaran" . $tahun . "]
                                ")); 
                db::statement("CREATE VIEW [dbo].[penetapan_anggaran" . $tahun . "] as
                        SELECT distinct tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,1) usulan,dbo.keteranganpenetapan" . $tahun . "(MONTH(dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,1))) ket_usulan
                        ,dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,2) anggaran_awal,dbo.keteranganpenetapan" . $tahun . "(MONTH(dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,2))) ket_ang
                        ,dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,3) anggaran_pak,dbo.keteranganpenetapan" . $tahun . "(MONTH(dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,3))) ket_ang_pak
                        ,dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,4) perkades,dbo.keteranganpenetapan" . $tahun . "(MONTH(dbo.TglPenetapanAnggaran" . $tahun . "(tahun,a.kd_desa,4))) ket_perkades
                        FROM ta_anggaranlog" . $tahun . " a
                        JOIN ref_desa" . $tahun . " b ON a.kd_desa=b.kd_desa
                        JOIN ref_kecamatan" . $tahun . " c ON c.Kd_Kec=b.Kd_Kec");

                // DB::statement("DROP VIEW [dbo].[proyeksi_bop" . $tahun . "]");
                DB::statement("  use [" . $user . "]   
                    if EXISTS (select * from sys.objects where object_id=object_id(N'[dbo].[proyeksi_bop" . $tahun . "]'))
                                drop view proyeksi_bop" . $tahun);
                db::statement("CREATE VIEW [dbo].[proyeksi_bop" . $tahun . "] AS
                                SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan, dbo.tigaPuluhPersenAng" . $tahun . "(tahun,a.kd_desa,'0') max_anggaran_awal,dbo.bopDesa" . $tahun . "(tahun,a.kd_desa,'0') bop_awal, dbo.tigaPuluhPersenAng" . $tahun . "(tahun,a.kd_desa,'1') max_anggaran_pak,dbo.bopDesa" . $tahun . "(tahun,a.kd_desa,'1') bop_pak
                                FROM (
                                    SELECT DISTINCT tahun,kd_desa
                                    FROM ta_anggaran" . $tahun . "
                                    ) a
                                join ref_desa" . $tahun . " b ON a.kd_desa=b.kd_desa
                                JOIN ref_kecamatan" . $tahun . " c ON c.Kd_Kec=b.Kd_Kec    ");

                // DB::statement("DROP VIEW [dbo].[bobot_bop" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[bobot_bop" . $tahun . "]') )
                                DROP view [dbo].[bobot_bop" . $tahun . "]
                                "));
                db::statement("CREATE VIEW [dbo].[bobot_bop" . $tahun . "] as
                    SELECT a.kd_desa, a.jumlah, b.jumlah bop, c.jumlah non_bop, CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2)) ELSE 0 END persen_bop, CASE WHEN CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2)) ELSE 0 END < 30 THEN 1 WHEN CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / a.jumlah) * 100 AS DECIMAL(10, 2)) ELSE 0 END=30 THEN 2 ELSE 3 END bobot_bop, a.jumlah_pak, b.jumlah_pak bop_pak, c.jumlah_pak non_bop_pak, CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END persen_bop_pak, CASE WHEN CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END < 30 THEN 1 WHEN CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END=30 THEN 2 ELSE 3 END bobot_bop_pak
                    FROM
                    (
                        SELECT kd_desa, SUM(anggaran) jumlah, SUM(anggaranstlhpak) jumlah_pak
                       FROM ta_rabrinci" . $tahun . "
                       WHERE kd_rincian LIKE '5%'
                       GROUP BY kd_desa
                    ) a
                    LEFT JOIN (
                        SELECT
                        kd_desa,
                        SUM(anggaran) jumlah,
                        SUM(anggaranstlhpak) jumlah_pak
                        FROM
                        ta_rabrinci" . $tahun . "
                        WHERE
                        kd_rincian LIKE '5%'
                        AND replace(kd_keg, kd_desa, '') IN ('01.01.01.', '01.01.02.', '01.01.05.', '01.01.06.')
                        GROUP BY
                        kd_desa
                    ) b ON a.kd_desa = b.kd_desa
                    LEFT JOIN (
                        SELECT
                        kd_desa,
                        SUM(anggaran) jumlah,
                        SUM(anggaranstlhpak) jumlah_pak
                        FROM
                        ta_rabrinci" . $tahun . "
                        WHERE
                        kd_rincian LIKE '5%'
                        AND replace(kd_keg, kd_desa, '') not IN ('01.01.01.', '01.01.02.', '01.01.05.', '01.01.06.')
                        GROUP BY
                        kd_desa
                    ) c ON a.kd_desa = c.kd_desa
    ");

                // DB::statement("DROP VIEW [dbo].[upah_pekerja" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[upah_pekerja" . $tahun . "]') )
                                DROP view [dbo].[upah_pekerja" . $tahun . "]
                                "));
                db::statement("CREATE VIEW [dbo].[upah_pekerja" . $tahun . "] AS 
                    SELECT a.kd_desa, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                        FROM
                        (
                            SELECT kd_desa, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                           FROM ta_rabrinci" . $tahun . " a
                            WHERE left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                            GROUP BY kd_desa
                        ) a
                        LEFT JOIN (
                            SELECT kd_desa, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                           FROM ta_rabrinci" . $tahun . " a
                            JOIN ref_rek1" . $tahun . " b ON left(a.kd_rincian, 2) = b.akun
                            WHERE left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                            GROUP BY kd_desa
                        ) b ON a.kd_desa = b.kd_desa");


                // DB::statement("DROP VIEW [dbo].[upah_pekerja" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[panjarFisikDanaDesa" . $tahun . "]') )
                                DROP view [dbo].[panjarFisikDanaDesa" . $tahun . "]
                                "));
                db::statement("CREATE VIEW [dbo].[panjarFisikDanaDesa" . $tahun . "] as
                    SELECT a.kd_desa, nama_desa, e.kd_kec, e.nama_kecamatan, a.no_spp, b.tgl_spp, a.kd_keg, nama_kegiatan, SUM(a.nilai) panjar,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu,(SUM(a.nilai) * 100) / NULLIF(case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END,0) persentase
                    FROM ta_spprinci" . $tahun . " a
                   JOIN ta_spp" . $tahun . " b ON a.kd_desa=b.kd_desa AND a.no_spp=b.no_spp
                    JOIN ta_kegiatan" . $tahun . " c ON c.kd_keg = a.kd_keg
                    JOIN ref_desa" . $tahun . " d ON d.kd_desa = a.kd_desa
                    JOIN Ref_Kecamatan" . $tahun . " e ON e.kd_kec = d.kd_kec
                    WHERE a.sumberdana='DDS' AND jn_spp='UM' and REPLACE(a.kd_keg, a.kd_desa, '') LIKE '02.03%'
                    GROUP BY a.kd_desa, nama_desa, e.kd_kec, e.nama_kecamatan, a.kd_keg, a.no_spp, b.tgl_spp, nama_kegiatan,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END ");

                // DB::statement("DROP VIEW [dbo].[setor_pajak" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[setor_pajak" . $tahun . "]') )
                                DROP view [dbo].[setor_pajak" . $tahun . "]
                                "));
                db::statement("CREATE VIEW [dbo].[setor_pajak" . $tahun . "] as
                            SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan, SUM(kredit) potongan ,SUM(debet) setor, SUM(kredit)-SUM(debet) saldo, ((SUM(kredit)-SUM(debet)) / NULLIF(SUM(kredit),0)) * 100 persentase
                            FROM [dbo].[QrSP_Jurnal" . $tahun . "] a
                            join ref_desa" . $tahun . " b ON a.kd_desa=b.kd_desa
                            JOIN ref_kecamatan" . $tahun . " c ON c.Kd_Kec=b.Kd_Kec
                            WHERE kd_rincian IN (SELECT kd_Potongan FROM ref_potongan" . $tahun . ") AND kd_source=8
                            GROUP BY tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan");

                // DB::statement("DROP VIEW [dbo].[faktor_resiko_sort" . $tahun . "]");
                DB::statement(db::raw("USE [" . $user . "]
                                IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[faktor_resiko_sort" . $tahun . "]') )
                                DROP view [dbo].[faktor_resiko_sort" . $tahun . "]
                                "));
                db::statement("CREATE view [dbo].[faktor_resiko_sort" . $tahun . "] as
                                select a.kd_desa, nama_desa, v1, v2, v3, v4, v5, v6, v7, v8,case when poin is null then 0 else poin end v9, total + case when poin is null then 0 else poin end total, tanggal
                                from faktor_resiko" . $tahun . " a
                                left join (
                                    select distinct kd_desa, 50 poin 
                                    from permintaan_pengawasan where tanggal_pengawasan is null
                                    and tahun='" . $tahun . "'
                                ) b on a.kd_desa = b.kd_desa");
                $msg = "Sukses";
                // DB::commit();
            } catch (\Throwable $th) {
                // DB::rollBack();
                $msg = $th->getMessage();
            }
            $this->info($msg);
        } else {
            $this->error("harus menyertakan tahun");
        }
    }
}
