<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Desa;

class WilayahController extends Controller
{
    //
    public function kecamatan(Request $request)
    {
        return kecamatan::get();
    }

    public function desa(Request $request)
    {
        // return kecamatan::get();
        $kecamatan = $request->kd_kec;
        if ($kecamatan <> '') {
            $desa = Desa::where('Kd_Kec', $kecamatan)->get();
        } else {
            $desa = Desa::get();
        }

        return $desa;
    }
}
