@extends('layouts.admin')
@section('title')
<h2>Penetapan APBDES
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
                                <th>Usulan</th>
                                <th>Anggaran</th>
                                <th>Anggaran PAK</th>
                                <th>Perkades</th>
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
        // console.log("ready!");
        $('#table').DataTable({
            processing: true,
            ordering: false,
            serverSide: false,
            ajax: "{{ url('/apbdes') }}",
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
                    data: 'tanggal_usulan',
                    name: 'usulan',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.ket_usulan != null) {
                            res += '<br><code>' + row.ket_usulan + '</code>';
                        }
                        return res;
                    }
                },
                {
                    data: 'tanggal_anggaran',
                    name: 'anggaran_awal',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.ket_ang != null) {
                            res += '<br><code>' + row.ket_ang + '</code>';
                        }
                        return res;
                    }
                },
                {
                    data: 'tanggal_pak',
                    name: 'anggaran_pak',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.ket_ang_pak != null) {
                            res += '<br><code>' + row.ket_ang_pak + '</code>';
                        }
                        return res;
                    }
                },
                {
                    data: 'tanggal_perkades',
                    name: 'perkades',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.ket_perkades != null) {
                            res += '<br><code>' + row.ket_perkades + '</code>';
                        }
                        return res;
                    }
                },
            ],

        });
    });
</script>
@endsection