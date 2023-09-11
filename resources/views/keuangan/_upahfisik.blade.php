<div class="card ">
    <div class="body">
        <div class="row">
            <div class="col-xs-12">

                <span class="pull-right">
                    <a href="{{ url('belanjafisik/pdf') }}?kd_desa={{ $kd_desa }}&pak={{ $pak }}&tahun={{ $tahun }}" target="_blank" class="btn btn-sm btn-warning" id="pdf">Cetak</a>
                    <button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button>
                </span>
            </div>
            <div class="col-xs-12">
                <h5 class='font-bold text-center'>KOMPOSISI BELANJA FISIK APBDES T.A. {{ $tahun }}</h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
                <h6 class='text-center col-pink'>Status : {{ $status }}</h6>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Uraian </th>
                    <th>Total Belanja </th>
                    <th colspan="2">Upah </th>
                    <th colspan="2">Non Upah </th>
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
                    <td>{{ $data->jenis }} {{ $data->nama_jenis }}</td>
                    <td class="text-right">{{ formatAngka($pak==1?$data->jumlah_pak:$data->jumlah,2) }}</td>
                    <td class="text-right">{{ formatAngka($pak==1?$data->upah_pak:$data->upah,2) }}</td>
                    <td class="text-center">{{ formatAngka($pak==1?$data->persen_pak:$data->persen,2) }}%</td>
                    {{--<td class="text-right">{{ formatAngka(($pak==1?$data->jumlah_pak:$data->jumlah) -  ($pak==1?$data->upah_pak:$data->upah),2) }}</td>--}}
                    <td class="text-right">{{ formatAngka(($pak==1?$data->jumlah_pak:$data->jumlah) -  ($pak==1?$data->upah_pak:$data->upah),2) }}</td>
                    <td class="text-center">{{ formatAngka(100 - ($pak==1?$data->persen_pak:$data->persen) ,2) }}%</td>
                </tr>
                @if($data->jenis=='')
                @php
                $bop=formatAngka($pak==1?$data->persen_pak:$data->persen,2);
                $nonbop=formatAngka(100 - ($pak==1?$data->persen_pak:$data->persen),2);
                @endphp
                @endif
                @endforeach
                <tr>
                    <td rowspan="2" colspan="3"></td>
                    <td colspan="4">Komposisi Upah Pekerja <b>{{ $bop }}%</b></td>
                </tr>
                <tr>
                    <td colspan="4">Komposisi Non Upah Pekerja <b>{{ $nonbop }}%</b></td>
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