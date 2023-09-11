<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengawasanKeuangan extends Model
{
    //
    protected $table = 'pengawasan_keuangan';
    protected $guarded = [];

    public function Desa()
    {
        return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
    }
}
