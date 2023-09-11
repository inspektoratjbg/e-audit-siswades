<?php

namespace App\Imports;

use App\PenilaianKecamatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenilaianImport implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        // $tahun = date('Y');
        $tahun = 2021;
        if (
            isset($row['kode']) &&
            isset($row['nilai'])
        ) {
            $fd = PenilaianKecamatan::where('kd_desa', $row['kode'])->where('tahun', $tahun);
            if ($fd->count() > 0) {
                //   update
                $fd->update([
                    'tahun' => $tahun,
                    'kd_desa' => $row['kode'],
                    'jumlah' => $row['nilai']
                ]);
            } else {
                //    insert
                PenilaianKecamatan::create([
                    'tahun' => $tahun,
                    'kd_desa' => $row['kode'],
                    'jumlah' => $row['nilai']
                ]);
            }
        } else {
            return null;
        }
        
    }
}
