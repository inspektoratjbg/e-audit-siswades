<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembinaanEvaluasi extends Model
{
    //
       //
       protected $table = 'pembinaan_evaluasi';
       protected $guarded = [];
   
       public function Desa()
       {
           return $this->hasOne('App\Desa', 'Kd_Desa', 'kd_desa');
       }
}
