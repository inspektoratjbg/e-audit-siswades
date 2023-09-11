<?php

namespace App\Imports;

use App\PengawasanKeuangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengawasanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tahun = 2021;
        if (
            isset($row['kode']) &&
            isset($row['nilai'])
        ) {
            $fd = PengawasanKeuangan::where('kd_desa', $row['kode'])->where('tahun', $tahun);
            if ($fd->count() > 0) {
                //   update
                $fd->update([
                    'tahun' => $tahun,
                    'kd_desa' => $row['kode'],
                    'jumlah' => $row['nilai']
                ]);
            } else {
                //    insert
                PengawasanKeuangan::create([
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
