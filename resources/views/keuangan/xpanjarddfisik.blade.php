@extends('layouts.admin')
@section('title')
<h2>SPP PANJAR DANA DESA KEGIATAN FISIK
    <div class="pull-right">
    </div>
</h2>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead class="bg-success text-white ">
                            <tr>
                                <th>Desa</th>
                                <th>SPP</th>
                                <th>Kegiatan</th>
                                <th>Pagu</th>
                                <th>Panjar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        function Keterangan(nilai) {
            if (nilai <= 15) {
                ket = 'Ringan';
            } else if (nilai > 15 && nilai <= 20) {
                ket = 'Sedang';
            } else {
                ket = 'Berat';
            }
            return ket;
        }

        $('#table').DataTable({
            processing: true,
            ordering: false,
            serverSide: false,
            ajax: "{{ url('panjardd') }}",
            columns: [{
                    data: 'nama_desa',
                    name: 'nama_desa',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.nama_kecamatan != null) {
                            res += '<br><code>' + row.nama_kecamatan + '</code>';
                        }

                        return res;
                    }
                },
                {
                    data: 'no_spp',
                    name: 'no_spp',

                },
                {
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',

                },
                {
                    data: 'pagu',
                    name: 'pagu',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);
                        /*   if (row.upah_pak != null) {
                              res += '<br><b>Upah</b> : ' + formatRupiah(row.upah_pak);
                          }
                          if (row.upah_pak != null && data != null) {
                              hasil = ((row.upah_pak / data) * 100);
                              res += '<br><code>' + parseInt(hasil) + '% ,' + Keterangan(hasil) + '</code>';
                          } */
                        return res;
                    }
                },
                {
                    data: 'panjar',
                    name: 'panjar',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);
                        res+='<br><code>'+parseInt(row.persentase)+'%</code>';
                        return res;

                    }


                }
            ]
        });
    });
</script>
@endsection