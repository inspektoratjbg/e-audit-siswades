<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembinaanKeuangan extends Model
{
    //
    protected $table = 'pembinaan_keuangan';
    protected $guarded = [];

    public function Desa()
    {
        return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
    }
}
