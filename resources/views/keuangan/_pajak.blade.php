<div class="card ">

    <div class="body">
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right">
                <a href="{{ url('pajak/pdf') }}?kd_desa={{ $kd_desa }}&tahun={{ $tahun }}" target="_blank" class="btn btn-sm btn-warning" id="pdf">Cetak</a>
                    <button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button>
                </div>
            </div>
            <div class="col-xs-12">
                <h5 class='font-bold text-center'>RINGKASAN PAJAK T.A. {{ $tahun }}</h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Pajak</th>
                            <th>Pemotongan</th>
                            <th>Penyetoran</th>
                            <th>Saldo</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $rk)
                        <tr>
                            <td>{{ $rk->kode }}</td>
                            <td>{{ $rk->uraian }}</td>
                            <td class="text-right">{{ formatAngka($rk->potongan,2) }}</td>
                            <td class="text-right">{{ formatAngka($rk->setor,2) }}</td>
                            <td class="text-right">{{ formatAngka($rk->saldo,2) }}</td>
                            <td class="text-center">{{ formatAngka($rk->persen,2) }}</td>
                        </tr>
                        @endforeach
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