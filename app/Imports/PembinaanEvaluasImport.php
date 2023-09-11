<?php

namespace App\Imports;

use App\PembinaanEvaluasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PembinaanEvaluasImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        
        $tahun = date('Y');
        if (
            isset($row['kode']) &&
            isset($row['nilai'])
        ) {
            $fd = PembinaanEvaluasi::where('kd_desa', $row['kode'])->where('tahun', $tahun);
            if ($fd->count() > 0) {
                //   update
                $fd->update([
                    'tahun' => $tahun,
                    'kd_desa' => $row['kode'],
                    'jumlah' => $row['nilai']
                ]);
            } else {
                //    insert
                PembinaanEvaluasi::create([
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
