<div class="card ">
    <div class="body">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right"><a href="{{ url('bop/pdf') }}?kd_desa={{ $kd_desa }}&pak={{ $pak }}&tahun={{ $tahun }}" target="_blank" class="btn btn-sm btn-warning" id="pdf">Cetak</a> <button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button></div>
            </div>
            <div class="col-md-12">
                <h5 class='font-bold text-center'>KOMPOSISIS BELANJA APBDES T.A. {{ $tahun }}</h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
                <h6 class='text-center col-pink'>Status : {{ $status }}</h6>
            </div>
        </div>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Uraian </th>
                    <th>Total Belanja </th>
                    <th colspan="2">BOP </th>
                    <th colspan="2">Non BOP </th>
                </tr>
                <tr>
                    <th> Rupiah</th>
                    <th> Rupiah</th>
                    <th>% </th>
                    <th> Rupiah</th>
                    <th>% </th>
                </tr>
            </thead>
            <tbody>
                @php
                $bop=0;
                $nonbop=0;
                @endphp

                @foreach($data as $data)
                <tr>
                    <td>{{ $data->kode }} {{ $data->jenis_belanja }}</td>
                    <td class="text-right">{{ formatAngka($data->jumlah,2) }}</td>
                    <td class="text-right">{{ formatAngka($data->jumlah_bop,2) }}</td>
                    <td class="text-center">{{ formatAngka($data->persen_bop,2) }}%</td>
                    <td class="text-right">{{ formatAngka($data->jumlah_non_bop,2) }}</td>
                    <td class="text-center">{{ formatAngka($data->persen_non_bop,2) }}%</td>
                </tr>
                @if($data->kode=='')
                @php
                $bop=formatAngka($data->persen_bop,2);
                $nonbop=formatAngka($data->persen_non_bop,2);
                @endphp
                @endif
                @endforeach
                <tr>
                    <td rowspan="2" colspan="3">Batas maksimal Biaya Operasional adalah 30% dari total belanja desa.</td>
                    <td colspan="4">Komposisi Belanja Operasional <b>{{ $bop }}%</b></td>
                </tr>
                <tr>
                    <td colspan="4">Komposisi Belanja Non Operasional <b>{{ $nonbop }}%</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#back").click(function() {
            $('#form').show();
            $('#res').hide();
        });
    });
</script>