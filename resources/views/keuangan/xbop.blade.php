@extends('layouts.admin')
@section('title')
<h2>PROYEKSI BOP
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
                                <th>BOP Anggaran</th>
                                <th>BOP Anggaran PAK</th>
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

            if (nilai < 30) {
                ket = 'Ringan';
            } else if(nilai==30) {
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
            ajax: "{{ url('bop') }}",
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
                    data: 'bop_awal',
                    name: 'bop_awal',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);
                        if (row.max_anggaran_awal != null) {
                            res += '<br>PAD : ' + formatRupiah(row.max_anggaran_awal) ;
                        }
                        if (row.max_anggaran_awal != null && data != null) {
                            hasil = ((data / row.max_anggaran_awal) * 100);
                            res += '<br><code>' + parseInt(hasil) + '% ,' + Keterangan(hasil) + '</code>';
                        }
                        return res;
                    }
                },
                {
                    data: 'bop_pak',
                    name: 'bop_pak',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);
                        if (row.max_anggaran_pak != null) {
                            res += '<br>PAD : ' + formatRupiah(row.max_anggaran_pak) ;
                        }
                        if (row.max_anggaran_pak != null && data != null) {
                            hasil = ((data / row.max_anggaran_pak) * 100);
                            res += '<br><code>' + parseInt(hasil) + '% ,' + Keterangan(hasil) + '</code>';
                        }
                        return res;
                    }
                }
            ],

        });
    });
</script>
@endsection