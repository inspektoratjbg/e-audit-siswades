<div class="card ">

    <div class="body">
        <div class="row">
            <div class="col-xs-12">
                <span class="pull-right">
                    <a href="{{ url('panjardd/pdf') }}?kd_desa={{ $kd_desa }}&tahun={{ $tahun}}" target="_blank" class="btn btn-sm btn-warning" id="pdf">Cetak</a>
                    <button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button>
                </span>
            </div>
            <div class="col-xs-12">
                <h5 class='font-bold text-center'>SPP PANJAR DANA DESA T.A. {{ $tahun }}</h5>
                <h5 class='font-bold col-cyan text-center'>KEGIATAN BELANJA FISIK</h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SPP</th>
                            <th>Kegiatan</th>
                            <th>Pagu</th>
                            <th>Panjar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($data as $rk)
                        <tr>
                            <td class="text-center">{{ $no }}</td>
                            <td>
                                {{ $rk->no_spp }}
                                <br> <small class="col-pink"> {{ tanggal_indonesia($rk->tgl_spp) }}</small>
                            </td>
                            <td>
                                {{ $rk->nama_kegiatan }}
                                <br> <small class="col-pink"> {{ $rk->kd_keg }}</small>
                            </td>
                            <td class="text-right">{{ formatAngka($rk->pagu,2) }}</td>
                            <td class="text-right">{{ formatAngka($rk->panjar,2) }}</td>
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                        <tr>
                            <td rowspan="3" colspan="2"> </td>
                            <td class="text-right font-bold">Pagu</td>
                            <td colspan="2" class="text-right ">{{ formatAngka($total->pagu,2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-right font-bold">Panjar</td>
                            <td colspan="2" class="text-right"> {{ formatAngka($total->panjar,2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-right font-bold">Persentase</td>
                            <td colspan="2" class="text-right"> {{ formatAngka($total->persen,2) }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

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