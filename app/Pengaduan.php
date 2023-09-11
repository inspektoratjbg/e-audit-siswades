<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    //
    protected $table = 'pengaduan_masyarakat';
    protected $guarded = [];

    public function Desa()
    {
        return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
    }
}
