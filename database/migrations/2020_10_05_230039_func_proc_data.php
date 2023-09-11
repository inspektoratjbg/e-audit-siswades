<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FuncProcData extends Migration
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

        // table faktor resiko
        DB::statement("CREATE TABLE faktor_resiko".$tahun."(
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


        DB::statement("CREATE FUNCTION [dbo].[bopDesa".$tahun."](@tahun int,@desa VARCHAR(10) , @param VARCHAR)
        RETURNS FLOAT
        BEGIN
        DECLARE @result float
        IF @param=1
            BEGIN 
                SELECT @result=SUM(anggaranstlhpak)
                FROM ta_rab".$tahun."
                WHERE kd_desa =@desa AND tahun=@tahun
                AND kd_rincian LIKE '5.1.%';
            end
        else
            begin
                SELECT @result=SUM(anggaran)
                FROM ta_rab".$tahun."
                WHERE kd_desa =@desa AND tahun=@tahun
                AND kd_rincian LIKE '5.1.%';
            end
        RETURN @result;
        end");



        DB::statement("CREATE FUNCTION [dbo].[getTotalModalFisik".$tahun."]
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
                FROM ta_rabrinci".$tahun." a
                WHERE kd_desa=@desa
                AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
                END 
                ELSE
                BEGIN
                SELECT @hasil=SUM(anggaran)
                FROM ta_rabrinci".$tahun." a
                WHERE kd_desa=@desa
                AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
                END 

                RETURN @hasil;
                END");

        DB::statement("CREATE FUNCTION [dbo].[keteranganPenetapan".$tahun."]  (@bulan int)
                        RETURNS varchar(20)
                        AS
                        BEGIN
                                return (SELECT CASE WHEN @bulan=1 THEN  'Ringan' WHEN @bulan=2 THEN 'Sedang' when @bulan>2 then 'Berat' ELSE null end )
                        END");

        DB::statement("CREATE FUNCTION [dbo].[TglPenetapanAnggaran".$tahun."](@thn INT,@desa VARCHAR(10),@posting INT)
                        RETURNS  datetime
                        AS
                        BEGIN
                            DECLARE @hasil datetime;
                            SELECT @hasil=tglposting
                            FROM ta_anggaranlog".$tahun."
                            where tahun=@thn AND kd_desa=@desa
                            AND kdposting=@posting;
                        
                            RETURN @hasil;
                        END");

        DB::statement("CREATE FUNCTION [dbo].[tigaPuluhPersenAng".$tahun."]
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
                                    ta_rab".$tahun."
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
                                    ta_rab".$tahun."
                                    where
                                    kd_rincian LIKE '4%'
                                    AND kd_rincian NOT LIKE '4.2.4%'
                                    AND kd_desa = @desa
                                    and tahun = @tahun;
                                end 
                            return @result;
                            END");

        DB::statement("CREATE FUNCTION [dbo].[upahPekerjaKonstruksi".$tahun."]
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
                                FROM ta_rabrinci".$tahun." a
                                WHERE kd_desa=@desa
                                AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                                    AND kd_rincian ='5.3.5.02.';
                            END  ELSE
                                BEGIN
                                    SELECT @hasil=SUM(anggaran)
                                    FROM ta_rabrinci".$tahun." a
                                    WHERE kd_desa=@desa
                                    AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                                        AND kd_rincian ='5.3.5.02.';
                                END 
                            RETURN @hasil;
                        END
            ");

        DB::statement("CREATE FUNCTION [dbo].[v_anggaran".$tahun."]
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
                                FROM ta_anggaranlog".$tahun."
                                WHERE kd_desa=@desa
                                AND kdposting=2;

                            -- Return the result of the function
                            RETURN @bobot;
                        END");

        DB::statement("CREATE FUNCTION [dbo].[v_bop".$tahun."]
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
                                ta_rabrinci".$tahun."
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
                                ta_rabrinci".$tahun."
                                WHERE
                                kd_desa = @desa
                                AND kd_rincian LIKE '5%'
                                AND replace(kd_keg, kd_desa, '') IN (
                                    SELECT
                                    *
                                    from
                                    ref_bel_operasional".$tahun."".$tahun."
                                )
                                GROUP BY
                                LEFT(kd_rincian, 1)
                            ) b ON a.kode = b.kode;
                            -- Return the result of the function
                            RETURN @bobot;
                            END");

        DB::statement("CREATE FUNCTION [dbo].[v_dumas".$tahun."]
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
                            kd_desa = @desa and tahun='".$tahun."';

                            IF @@ROWCOUNT = 0 
                            begin
                                set     @hasil = 0;
                            end 
                        return @hasil;
                        END
            ");

        DB::statement("CREATE FUNCTION [dbo].[v_fisik".$tahun."]
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
                            ta_rabrinci".$tahun." a
                            JOIN ref_rek1".$tahun." b ON left(a.kd_rincian, 2) = b.akun
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
                            ta_rabrinci".$tahun." a
                            JOIN ref_rek1".$tahun." b ON left(a.kd_rincian, 2) = b.akun
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

        DB::statement("CREATE FUNCTION [dbo].[v_pajak".$tahun."]
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
                            FROM Ta_Pencairan".$tahun." AS A
                            INNER JOIN Ta_SPPPot".$tahun." AS B ON A.No_SPP = B.No_SPP
                            WHERE a.kd_desa=@desa
                            AND kd_rincian IN (
                                SELECT kd_Potongan FROM ref_potongan".$tahun."
                            )
                            GROUP BY
                            B.Kd_Rincian
                            UNION
                            SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                          FROM Ta_Pajak".$tahun." AS A
                            INNER JOIN Ta_PajakRinci".$tahun." AS B ON A.No_SSP = B.No_SSP
                            WHERE a.kd_desa=@desa
                            AND a.kd_rincian IN (
                                SELECT kd_Potongan FROM ref_potongan".$tahun."
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

        DB::statement("CREATE FUNCTION [dbo].[v_panjar".$tahun."]
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
                                FROM TA_SPPRINCI".$tahun." A
                                JOIN TA_SPP".$tahun." B ON A.KD_DESA = B.KD_DESA
                                AND A.NO_SPP = B.NO_SPP
                                JOIN TA_KEGIATAN".$tahun." C ON C.KD_KEG = A.KD_KEG
                                WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                            ) pagu
                        );
                        
                        set @panjar=(
                            SELECT SUM(a.nilai) panjar
                            FROM TA_SPPRINCI".$tahun." A
                            JOIN TA_SPP".$tahun." B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                            JOIN TA_KEGIATAN".$tahun." C ON C.KD_KEG = A.KD_KEG
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

        DB::statement("CREATE FUNCTION [dbo].[v_pembKeuangan".$tahun."]
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
                        where kd_desa=@desa and tahun='".$tahun."';
                            IF @@ROWCOUNT = 0
                                begin
                                    set @hasil = 0;
                                end
                                return @hasil;
                        END
                        ");

        DB::statement("CREATE FUNCTION v_pengKeuangan".$tahun."
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
                                where kd_desa=@desa and tahun='".$tahun."';
                                IF @@ROWCOUNT = 0
                                    begin
                                        set @hasil = 0;
                                    end        
                                return @hasil;
                            END");

        // finish function

        // ###############################   awal procedure ############

DB::statement("CREATE PROCEDURE [dbo].[sp_upah_pekerja".$tahun."] @desa nvarchar(10)
                AS
                BEGIN
                    SELECT a.jenis, a.nama_jenis, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                    FROM
                    (
                        SELECT b.jenis, nama_jenis, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci".$tahun." a
                        JOIN ref_rek3".$tahun." b ON left(a.kd_rincian, 6) = b.jenis
                        WHERE kd_desa='01.2001.' AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                        GROUP BY b.jenis, nama_jenis
                    ) a
                    LEFT JOIN (
                        SELECT b.jenis, nama_jenis, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci".$tahun." a
                        JOIN ref_rek3".$tahun." b ON left(a.kd_rincian, 6) = b.jenis
                       WHERE kd_desa='01.2001.' AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                        GROUP BY b.jenis, nama_jenis
                    ) b ON a.jenis = b.jenis
                    union
                    SELECT NULL akun, 'Jumlah' nama_akun, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                    FROM
                    (
                        SELECT akun, nama_akun, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci".$tahun." a
                        JOIN ref_rek1".$tahun." b ON left(a.kd_rincian, 2) = b.akun
                        WHERE kd_desa=@desa AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                       GROUP BY akun, nama_akun
                    ) a
                    LEFT JOIN (
                        SELECT akun, nama_akun, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                        FROM ta_rabrinci".$tahun." a
                        JOIN ref_rek1".$tahun." b ON left(a.kd_rincian, 2) = b.akun
                        WHERE kd_desa=@desa AND left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                        GROUP BY akun, nama_akun
                    ) b ON a.akun = b.akun
                    END");

DB::statement("CREATE PROCEDURE [dbo].[sp_total_panjar".$tahun."] @desa nvarchar(10) AS
                BEGIN 
                declare @pagu float, @panjar float, @persen float;
                set @pagu=(
                        SELECT SUM(pagu)
                            FROM
                            (
                                SELECT distinct a.kd_keg,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu
                            FROM TA_SPPRINCI".$tahun." A
                                JOIN TA_SPP".$tahun." B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                                JOIN TA_KEGIATAN".$tahun." C ON C.KD_KEG = A.KD_KEG
                            WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                            ) pagu
                        );


                set @panjar=(
                    SELECT SUM(a.nilai) panjar
                   FROM TA_SPPRINCI".$tahun." A
                   JOIN TA_SPP".$tahun." B ON A.KD_DESA=B.KD_DESA AND A.NO_SPP=B.NO_SPP
                    JOIN TA_KEGIATAN".$tahun." C ON C.KD_KEG = A.KD_KEG
                    WHERE A.SUMBERDANA='DDS' AND JN_SPP='UM' AND A.KD_DESA=@desa AND REPLACE(A.KD_KEG, A.KD_DESA, '') LIKE '02.03%'
                );

                if @panjar > 0 begin
                    SET @persen=cast(@panjar / nullif(@pagu,0) * 100 as decimal(10, 2));
                end
                else begin
                    set @persen=null
                end
                select @pagu pagu, @panjar panjar, @persen persen;
            END
");

DB::statement("CREATE PROCEDURE [dbo].[sp_pajak".$tahun."] @desa nvarchar(10) AS
                BEGIN
                SELECT '1' sc, kd_rincian kode, nama_obyek uraian, SUM(potongan) potongan, SUM(setor) setor, SUM(potongan) - SUM(setor) saldo, CAST( (SUM(potongan) - SUM(setor)) / NULLIF(SUM(potongan),0) * 100 AS DECIMAL(10, 2) ) persen
                FROM
                (
                SELECT B.Kd_Rincian, Sum(B.Nilai) AS potongan, Sum(0) AS setor
                    FROM Ta_Pencairan".$tahun." AS A
                    INNER JOIN Ta_SPPPot".$tahun." AS B ON A.No_SPP = B.No_SPP
                WHERE a.kd_desa=@desa AND kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan".$tahun." )
                GROUP BY B.Kd_Rincian
                    UNION
                    SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                    FROM Ta_Pajak".$tahun." AS A
                    INNER JOIN Ta_PajakRinci".$tahun." AS B ON A.No_SSP = B.No_SSP
                WHERE a.kd_desa=@desa AND a.kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan".$tahun." )
                    GROUP BY B.Kd_Rincian
                ) a
                JOIN ref_rek4".$tahun." b ON a.kd_rincian = b.obyek
                    GROUP BY kd_rincian, nama_obyek
                    UNION all
                    SELECT '2' sc, null kode, 'Jumlah' uraian, SUM(potongan) potongan, SUM(setor) setor, SUM(potongan) - SUM(setor) saldo, CAST( (SUM(potongan) - SUM(setor)) / NULLIF(SUM(potongan),0) * 100 AS DECIMAL(10, 2) ) persen
                    FROM
                    (
                    SELECT B.Kd_Rincian, Sum(B.Nilai) AS potongan, Sum(0) AS setor
                    FROM Ta_Pencairan".$tahun." AS A
                    INNER JOIN Ta_SPPPot".$tahun." AS B ON A.No_SPP = B.No_SPP
                    WHERE a.kd_desa=@desa AND kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan".$tahun." )
                    GROUP BY B.Kd_Rincian
                    UNION
                    SELECT B.Kd_Rincian, SUM(0) potongan, Sum(B.Nilai) setor
                    FROM Ta_Pajak".$tahun." AS A
                    INNER JOIN Ta_PajakRinci".$tahun." AS B ON A.No_SSP = B.No_SSP
                    WHERE a.kd_desa=@desa AND a.kd_rincian IN ( SELECT kd_Potongan FROM ref_potongan".$tahun." )
                    GROUP BY B.Kd_Rincian
                ) a;
                END
");

DB::statement("CREATE PROCEDURE [dbo].[sp_komposisi_belanja".$tahun."]
	
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
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
GROUP BY LEFT(kd_rincian,4)
) a
LEFT JOIN (
SELECT LEFT(kd_rincian,4) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
AND  replace(kd_keg,kd_desa,'')  IN (SELECT * from ref_bel_operasional".$tahun.")
GROUP BY LEFT(kd_rincian,4)
) b ON a.kode=b.kode
LEFT JOIN (
SELECT LEFT(kd_rincian,4) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
AND  replace(kd_keg,kd_desa,'') not IN (SELECT * from ref_bel_operasional".$tahun.")
GROUP BY LEFT(kd_rincian,4) 
 ) c ON a.kode=c.kode
 JOIN ref_rek2".$tahun." d ON d.kelompok=a.kode
UNION 
 SELECT  NULL kode,'Jumlah' jeins_belanja,a.jumlah,b.jumlah jumlah_bop, case when a.jumlah is not null then   CAST( (b.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2)) else 0 end persen_bop  ,c.jumlah jumlah_non_bop,case when a.jumlah is not null then  CAST((c.jumlah/NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10,2) ) else 0 end persen_non_bop
FROM (
SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
GROUP BY LEFT(kd_rincian,1)
) a
LEFT JOIN (
SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
AND  replace(kd_keg,kd_desa,'')  IN (SELECT * from ref_bel_operasional".$tahun.")
GROUP BY LEFT(kd_rincian,1)
) b ON a.kode=b.kode
LEFT JOIN (
SELECT LEFT(kd_rincian,1) kode,case when @pak=1 then  SUM(anggaranstlhpak) else  SUM(anggaran) end  jumlah
FROM ta_rabrinci".$tahun."
WHERE kd_desa=@desa
AND kd_rincian LIKE '5%'
AND  replace(kd_keg,kd_desa,'') not IN (SELECT * from ref_bel_operasional".$tahun.")
GROUP BY LEFT(kd_rincian,1)
 ) c ON a.kode=c.kode;

END");

DB::statement("CREATE PROCEDURE [dbo].[generate_faktor_resiko".$tahun."] 
                        AS
                        BEGIN
                            DELETE FROM faktor_resiko".$tahun.";
                            INSERT INTO [dbo].[faktor_resiko".$tahun."] ([kd_desa] ,[nama_desa] ,[v1] ,[v2] ,[v3] ,[v4] ,[v5] ,[v6] ,[v7] ,[v8] ,[total] ,[tanggal])
                            SELECT kd_desa,nama_desa,dbo.v_anggaran".$tahun."(kd_desa) v1,dbo.v_bop".$tahun."(kd_desa) v2,dbo.v_fisik".$tahun."(kd_desa) v3,dbo.v_panjar".$tahun."(kd_desa) v4,dbo.v_pajak".$tahun."(kd_desa) v5, dbo.v_pembKeuangan".$tahun."(kd_desa) v6,dbo.v_pengKeuangan".$tahun."(kd_desa) v7,dbo.v_dumas".$tahun."(kd_desa) v8, dbo.v_anggaran".$tahun."(kd_desa) + dbo.v_bop".$tahun."(kd_desa) + dbo.v_fisik".$tahun."(kd_desa) + dbo.v_panjar".$tahun."(kd_desa) + dbo.v_pajak".$tahun."(kd_desa) + dbo.v_pembKeuangan".$tahun."(kd_desa) + dbo.v_pengKeuangan".$tahun."(kd_desa) + dbo.v_dumas".$tahun."(kd_desa) total, getdate() tanggal
                            FROM ref_desa".$tahun.";
                        END
");

DB::statement("CREATE PROCEDURE [dbo].[ringkasan_keuangan".$tahun."]
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
        FROM [dbo].[Ta_SPP".$tahun."] 
        WHERE Kd_Desa=@desa;

	insert into @ringkasan
	select null,'-',keterangan,nilai from @spp;

	declare @kwitansi table(keterangan varchar(100),nilai money);
	insert into @kwitansi
	SELECT 'Register Kwitansi',sum(nilai) nilai from (
            select sum(nilai) nilai
                from ta_sppbukti".$tahun."
            where Kd_Desa=@desa
            union all
            select sum(nilai) from Ta_SPJBukti".$tahun." where Kd_Desa=@desa ) a;

	insert into @ringkasan
	select null,'-',keterangan,nilai from @kwitansi;
	
	insert into @ringkasan
	 select null,'-','Selisih',(select nilai from @spp ) - (select nilai from @kwitansi);

	insert into @ringkasan
	select 'II',null,'Pendapatan (Anggaran Pendapatan di APBDes)',null;

	declare @apad table(keterangan varchar(100),nilai money);
	insert into @apad
	SELECT 'Anggaran Pendapatan',case when sum(anggaranstlhpak) is not null or sum(anggaranstlhpak) !=0 then sum(anggaranstlhpak) else  sum(anggaran) end 
                                    from ta_rab".$tahun."
                                    where kd_desa=@desa
                                    and left(Kd_Rincian,1)=4;
	insert into @ringkasan
	select null,'-',keterangan,nilai from @apad;
	 
	declare @rpad table(keterangan varchar(100),nilai money);
	insert into @rpad
	select 'Real. Pendapatan s/d Pemeriksaan',(SUM(debet) + SUM(kredit)) FROM (
	SELECT 12 AS Kd_Source, A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian, 'K' AS D_K, Sum(0) AS Debet, Sum(A.Nilai) AS Kredit
	FROM Ta_Mutasi".$tahun." AS A
	WHERE (((A.Kd_Mutasi)=3)) AND kd_desa=@desa
	GROUP BY A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian  
	UNION all
	SELECT 2 AS Kd_Source, A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, B.Kd_Rincian, 'K' AS D_K, Sum(0) AS Debet, Sum(B.Nilai) AS Kredit
	FROM Ta_TBP".$tahun." AS A INNER JOIN Ta_TBPRinci".$tahun." AS B ON A.No_Bukti = B.No_Bukti
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
                                    from ta_rab".$tahun."
                                    where kd_desa=@desa
                                    and left(Kd_Rincian,1)=5;
	
	insert into @ringkasan
	select null,'-',keterangan,nilai from @abelanja;

	declare @rbelanja table(keterangan varchar(100),nilai money);
	insert into @rbelanja
	SELECT 'Realisasi Belanja s/d Pemeriksaan',SUM(nilai) FROM (     
	SELECT  Sum(A.Nilai) nilai
	FROM Ta_Mutasi".$tahun." AS A
	WHERE (((A.Kd_Mutasi)=4)) AND Kd_Desa=@desa AND LEFT(Kd_Rincian,1)=5
	GROUP BY A.Tahun, A.Kd_Desa, A.Tgl_Bukti, A.No_Bukti, A.Kd_Rincian
	UNION all
	SELECT  Sum(B.Nilai) nilai
	FROM (Ta_SPP".$tahun." AS A INNER JOIN Ta_SPPRinci".$tahun." AS B ON A.No_SPP = B.No_SPP) INNER JOIN Ta_Pencairan".$tahun." AS C ON A.No_SPP = C.No_SPP
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
        from Ta_RAB".$tahun."
        where Kd_Desa=@desa
        and Kd_Rincian='6.1.1.01.';

	insert into @ringkasan
	select null,'-',keterangan,nilai from @silpa_tahun_lalu;

	declare @penerimaan_pembiayaan table(keterangan varchar(100),nilai money);

	insert into @penerimaan_pembiayaan
	SELECT 'Penerimaan Pembiayaan',sum(B.Debet+ B.Kredit)
FROM Ta_JurnalUmum".$tahun." AS A INNER JOIN Ta_JurnalUmumRinci".$tahun." AS B ON A.NoBukti = B.NoBukti
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
         FROM QRSP_JURNAL".$tahun."
         WHERE KD_DESA=@desa
         AND KD_RINCIAN='1.1.1.01.'
         UNION ALL
         SELECT DEBET,KREDIT
         FROM TA_SALDOAWAL".$tahun."
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
         from QrSP_Jurnal".$tahun."
         where Kd_Desa='01.2002.'
         and Kd_Rincian=@desa
         union all
         select debet,Kredit
         from Ta_SaldoAwal".$tahun."
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
        FROM QRSP_JURNAL".$tahun."
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
	where kd_desa=@desa and tahun='".$tahun."';

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
	select ".$tahun." tahun,@desa kd_desa,a.*,GETDATE() created_at,GETDATE() updated_at FROM @ringkasan a;
END
");

db::statement("CREATE VIEW [dbo].[penetapan_anggaran".$tahun."] as
                    SELECT distinct tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan,dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,1) usulan,dbo.keteranganpenetapan".$tahun."(MONTH(dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,1))) ket_usulan
                    ,dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,2) anggaran_awal,dbo.keteranganpenetapan".$tahun."(MONTH(dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,2))) ket_ang
                    ,dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,3) anggaran_pak,dbo.keteranganpenetapan".$tahun."(MONTH(dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,3))) ket_ang_pak
                    ,dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,4) perkades,dbo.keteranganpenetapan".$tahun."(MONTH(dbo.TglPenetapanAnggaran".$tahun."(tahun,a.kd_desa,4))) ket_perkades
                    FROM ta_anggaranlog".$tahun." a
                    JOIN ref_desa".$tahun." b ON a.kd_desa=b.kd_desa
                    JOIN ref_kecamatan".$tahun." c ON c.Kd_Kec=b.Kd_Kec
");

db::statement("CREATE VIEW [dbo].[proyeksi_bop".$tahun."] AS
        SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan, dbo.tigaPuluhPersenAng".$tahun."(tahun,a.kd_desa,'0') max_anggaran_awal,dbo.bopDesa".$tahun."(tahun,a.kd_desa,'0') bop_awal, dbo.tigaPuluhPersenAng".$tahun."(tahun,a.kd_desa,'1') max_anggaran_pak,dbo.bopDesa".$tahun."(tahun,a.kd_desa,'1') bop_pak
        FROM (
            SELECT DISTINCT tahun,kd_desa
            FROM ta_anggaran".$tahun."
            ) a
        join ref_desa".$tahun." b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan".$tahun." c ON c.Kd_Kec=b.Kd_Kec
");


db::statement("CREATE VIEW [dbo].[bobot_bop".$tahun."] as
                SELECT a.kd_desa, a.jumlah, b.jumlah bop, c.jumlah non_bop, CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2)) ELSE 0 END persen_bop, CASE WHEN CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / NULLIF(a.jumlah,0)) * 100 AS DECIMAL(10, 2)) ELSE 0 END < 30 THEN 1 WHEN CASE WHEN a.jumlah >0 THEN CAST((b.jumlah / a.jumlah) * 100 AS DECIMAL(10, 2)) ELSE 0 END=30 THEN 2 ELSE 3 END bobot_bop, a.jumlah_pak, b.jumlah_pak bop_pak, c.jumlah_pak non_bop_pak, CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END persen_bop_pak, CASE WHEN CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END < 30 THEN 1 WHEN CASE WHEN a.jumlah_pak >0 THEN CAST( (b.jumlah_pak / NULLIF(a.jumlah_pak,0)) * 100 AS DECIMAL(10, 2) ) ELSE 0 END=30 THEN 2 ELSE 3 END bobot_bop_pak
                FROM
                (
                    SELECT kd_desa, SUM(anggaran) jumlah, SUM(anggaranstlhpak) jumlah_pak
                   FROM ta_rabrinci".$tahun."
                   WHERE kd_rincian LIKE '5%'
                   GROUP BY kd_desa
                ) a
                LEFT JOIN (
                    SELECT
                    kd_desa,
                    SUM(anggaran) jumlah,
                    SUM(anggaranstlhpak) jumlah_pak
                    FROM
                    ta_rabrinci".$tahun."
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
                    ta_rabrinci".$tahun."
                    WHERE
                    kd_rincian LIKE '5%'
                    AND replace(kd_keg, kd_desa, '') not IN ('01.01.01.', '01.01.02.', '01.01.05.', '01.01.06.')
                    GROUP BY
                    kd_desa
                ) c ON a.kd_desa = c.kd_desa

");

db::statement("CREATE VIEW [dbo].[upah_pekerja".$tahun."] AS 
                SELECT a.kd_desa, a.jumlah, a.jumlah_pak, b.jumlah upah, b.jumlah_pak upah_pak, cast(b.jumlah / NULLIF(a.jumlah,0) * 100 AS DECIMAL(10, 2)) persen, cast(b.jumlah_pak / NULLIF(a.jumlah_pak,0) * 100 AS DECIMAL(10, 2)) persen_pak
                    FROM
                    (
                        SELECT kd_desa, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                       FROM ta_rabrinci".$tahun." a
                        WHERE left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8')
                        GROUP BY kd_desa
                    ) a
                    LEFT JOIN (
                        SELECT kd_desa, sum(anggaran) jumlah, sum(anggaranstlhpak) jumlah_pak
                       FROM ta_rabrinci".$tahun." a
                        JOIN ref_rek1".$tahun." b ON left(a.kd_rincian, 2) = b.akun
                        WHERE left(kd_rincian, 5) IN ('5.3.4', '5.3.5', '5.3.6', '5.3.7', '5.3.8') AND kd_rincian LIKE '%02.'
                        GROUP BY kd_desa
                    ) b ON a.kd_desa = b.kd_desa

");

db::statement("CREATE VIEW [dbo].[panjarFisikDanaDesa".$tahun."] as
                SELECT a.kd_desa, nama_desa, e.kd_kec, e.nama_kecamatan, a.no_spp, b.tgl_spp, a.kd_keg, nama_kegiatan, SUM(a.nilai) panjar,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END pagu,(SUM(a.nilai) * 100) / NULLIF(case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END,0) persentase
                FROM ta_spprinci".$tahun." a
               JOIN ta_spp".$tahun." b ON a.kd_desa=b.kd_desa AND a.no_spp=b.no_spp
                JOIN ta_kegiatan".$tahun." c ON c.kd_keg = a.kd_keg
                JOIN ref_desa".$tahun." d ON d.kd_desa = a.kd_desa
                JOIN Ref_Kecamatan".$tahun." e ON e.kd_kec = d.kd_kec
                WHERE a.sumberdana='DDS' AND jn_spp='UM' and REPLACE(a.kd_keg, a.kd_desa, '') LIKE '02.03%'
                GROUP BY a.kd_desa, nama_desa, e.kd_kec, e.nama_kecamatan, a.kd_keg, a.no_spp, b.tgl_spp, nama_kegiatan,case when pagu_pak IS NULL THEN pagu ELSE pagu_pak END

");

db::statement("CREATE VIEW [dbo].[setor_pajak".$tahun."] as
        SELECT tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan, SUM(kredit) potongan ,SUM(debet) setor, SUM(kredit)-SUM(debet) saldo, ((SUM(kredit)-SUM(debet)) / NULLIF(SUM(kredit),0)) * 100 persentase
        FROM [dbo].[QrSP_Jurnal".$tahun."] a
        join ref_desa".$tahun." b ON a.kd_desa=b.kd_desa
        JOIN ref_kecamatan".$tahun." c ON c.Kd_Kec=b.Kd_Kec
        WHERE kd_rincian IN (SELECT kd_Potongan FROM ref_potongan".$tahun.") AND kd_source=8
        GROUP BY tahun,a.kd_desa,nama_desa,b.kd_kec,nama_kecamatan
");

db::statement("CREATE view [dbo].[faktor_resiko_sort".$tahun."] as
            select a.kd_desa, nama_desa, v1, v2, v3, v4, v5, v6, v7, v8,case when poin is null then 0 else poin end v9, total + case when poin is null then 0 else poin end total, tanggal
            from faktor_resiko".$tahun." a
            left join (
                select distinct kd_desa, 50 poin 
                from permintaan_pengawasan where tanggal_pengawasan is null
                and tahun='".$tahun."'
            ) b on a.kd_desa = b.kd_desa
");

      

  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
