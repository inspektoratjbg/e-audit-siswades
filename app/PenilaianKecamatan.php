<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianKecamatan extends Model
{
    protected $table = 'penilaian_kecamatan';
    protected $guarded = [];

    public function Desa()
    {
        return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
    }
}
