@extends('layouts.admin')
@section('title')
<h2>SEKTOR PAJAK
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
                                <th>Potongan</th>
                                <th>Setor</th>
                                <th>Saldo</th>
                                <th>%</th>
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
            ajax: "{{ url('pajak') }}",
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
                    data: 'potongan',
                    name: 'potongan',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);  
                        return res;
                    }
                },
                {
                    data: 'setor',
                    name: 'setor',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);  
                        return res;
                    }
                },
                {
                    data: 'saldo',
                    name: 'saldo',
                    render: function(data, type, row) {
                        var res = formatRupiah(data);  
                        return res;
                    }
                },
                {
                    data: 'persentase',
                    name: 'persentase',
                    render: function(data, type, row) {
                        // var res = formatRupiah(data);  
                        return parseFloat(data)+'%';
                    }
                },
               
            ]
        });
    });
</script>
@endsection