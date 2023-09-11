<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerintahPengawasan extends Model
{
    //
    protected $table = 'permintaan_pengawasan';
    protected $guarded = [];

    public function Desa()
    {
        return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
    }
}
