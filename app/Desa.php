<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = 'ref_desa2020';

    public function Kecamatan()
    {
        return $this->hasOne('App\Kecamatan', 'Kd_Kec', 'Kd_Kec');
    }
}
