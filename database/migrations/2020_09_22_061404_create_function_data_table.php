<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
/* 
        DB::statement("CREATE FUNCTION TglPenetapanAnggaran(@thn INT,@desa VARCHAR(10),@posting INT)
        RETURNS  datetime
        AS
        BEGIN
            DECLARE @hasil datetime;
            SELECT @hasil=tglposting
            FROM ta_anggaranlog
            where tahun=@thn AND kd_desa=@desa
            AND kdposting=@posting;
        
            RETURN @hasil;
        END");

        DB::statement("CREATE FUNCTION keteranganPenetapan  (@bulan int)
        RETURNS varchar(20)
        AS
        BEGIN
            return (SELECT CASE WHEN @bulan=1 THEN  'Ringan' WHEN @bulan=2 THEN 'Sedang' when @bulan>2 then 'Berat' ELSE null end )
        END");

        DB::statement("CREATE FUNCTION bopDesa(@tahun int,@desa VARCHAR(10) , @param VARCHAR)
        RETURNS FLOAT
        BEGIN
        DECLARE @result float
        IF @param=1
            BEGIN 
                SELECT @result=SUM(anggaranstlhpak)
                FROM ta_rab
                WHERE kd_desa =@desa AND tahun=@tahun
                AND kd_rincian LIKE '5.1.%';
            end
        else
            begin
                SELECT @result=SUM(anggaran)
                FROM ta_rab
                WHERE kd_desa =@desa AND tahun=@tahun
                AND kd_rincian LIKE '5.1.%';
            end
        RETURN @result;
        end");

        DB::statement("CREATE FUNCTION getTotalModalFisik
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
          FROM ta_rabrinci a
          WHERE kd_desa=@desa
          AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
        END 
        ELSE
        BEGIN
        SELECT @hasil=SUM(anggaran)
          FROM ta_rabrinci a
          WHERE kd_desa=@desa
          AND replace(kd_keg,kd_desa,'') LIKE '02.03%';
        END 

        RETURN @hasil;
        END");

        DB::statement("CREATE FUNCTION tigaPuluhPersenAng
            (
                @tahun  int,@desa varchar(10), @param varchar
            )
            RETURNS float
            AS
            BEGIN
            DECLARE @result float;
            
            if @param=1
            begin 
                SELECT  @result=(SUM(anggaranstlhpak) * 0.30 )
                FROM ta_rab
                where kd_rincian LIKE  '4%' 
                AND kd_rincian NOT LIKE '4.2.4%' AND kd_desa=@desa and tahun=@tahun;
            end
            else 
            begin 
                SELECT  @result=(SUM(anggaran) * 0.30 )
                FROM ta_rab
                where kd_rincian LIKE  '4%' 
                AND kd_rincian NOT LIKE '4.2.4%' AND kd_desa=@desa and tahun=@tahun;
            end
            return @result;
            END");

        DB::statement("CREATE FUNCTION upahPekerjaKonstruksi
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
              FROM ta_rabrinci a
              WHERE kd_desa=@desa
              AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                AND kd_rincian ='5.3.5.02.';
            END 
            ELSE
            BEGIN
            SELECT @hasil=SUM(anggaran)
              FROM ta_rabrinci a
              WHERE kd_desa=@desa
              AND replace(kd_keg,kd_desa,'') LIKE '02.03%'
                AND kd_rincian ='5.3.5.02.';
            END 
            RETURN @hasil;
            END"); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /*  DB::statement("DROP FUNCTION TglPenetapanAnggaran");
        DB::statement("DROP FUNCTION TglPenetapanAnggaran");
        DB::statement("DROP FUNCTION keteranganPenetapan  ");
        DB::statement("DROP FUNCTION bopDesa");
        DB::statement("DROP FUNCTION getTotalModalFisik");
        DB::statement("DROP FUNCTION tigaPuluhPersenAng");
        DB::statement("DROP FUNCTION upahPekerjaKonstruksi"); */
    }
}
