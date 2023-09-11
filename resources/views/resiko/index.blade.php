@extends('layouts.admin')
@section('title')
<h2>FAKTOR RESIKO DESA
    <div class="pull-right">
        <b>Tarik data :</b> <span id="tanggal">{{ $tanggal }} </span> <button id="refresh" class="btn btn-xs btn-success waves-effect"><i class="material-icons">refresh</i> <span>Perbarui data</span></button>
        <a href="{{ url('resiko/pdf') }}" target="_blank" class="btn btn-sm btn-warning" id="pdf">Cetak</a>
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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Desa</th>
                                <th>V1</th>
                                <th>V2</th>
                                <th>V3</th>
                                <th>V4</th>
                                <th>V5</th>
                                <th>V6</th>
                                <th>V7</th>
                                <th>V8</th>
                                <th>V9</th>
                                {{-- <th>V10</th> --}}
                                <th>Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <b>Keterangan:</b>
                <ul>
                    <li>
                        <span>V1: Penetapan APBDES</span>
                    </li>
                    <li>
                        <span>V2: BOP</span>
                    </li>
                    <li>
                        <span>V3: Upah Pekerja</span>
                    </li>
                    <li>
                        <span>V4: Panjar DD</span>
                    </li>
                    <li>
                        <span>V5: Pajak</span>
                    </li>
                    <li>
                        <span>V6: Pembinaan</span>
                    </li>
                    <li>
                        <span>V7: Pengawasan</span>
                    </li>
                    <li>
                        <span>V8: Pengaduan Masyarakat</span>
                    </li>
                    <li>
                        <span>V9: Penilaian Kecamatan</span>
                    </li>
                    {{-- <li>
                        <span>V10: Perintah Pengawasan</span>
                    </li> --}}
                </ul>
            </div>
        </div>


    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        // console.log("ready!");
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $('#table').DataTable({
            processing: true,
            // ordering: false,
            serverSide: false,
            ajax: "{{ url('/resiko') }}",
            columns: [{
                    data: 'kd_desa',
                    name: 'kd_desa',
                    orderable: false,
                },
                {
                    data: 'kd_desa',
                    name: 'kd_desa',
                    orderable: false,
                },
                {
                    data: 'nama_desa',
                    name: 'nama_desa',
                    orderable: false,
                },
                {
                    data: 'v1',
                    name: 'v1',
                },
                {
                    data: 'v2',
                    name: 'v2',

                },
                {
                    data: 'v3',
                    name: 'v3',
                },
                {
                    data: 'v4',
                    name: 'v4',
                },
                {
                    data: 'v5',
                    name: 'v5',
                },
                {
                    data: 'v6',
                    name: 'v6',
                },
                {
                    data: 'v7',
                    name: 'v7',
                },
                {
                    data: 'v8',
                    name: 'v8',
                },
                {
                    data: 'v9',
                    name: 'v9',
                },
                // {
                //     data: 'v10',
                //     name: 'v10',
                // },
                {
                    data: 'total',
                    name: 'total',

                },

            ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        function getRndInteger(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        $("#refresh").click(function(e) {
            e.preventDefault();


            loading();
            $.ajax({
                url: "{{ url('resiko/refresh') }}",
                success: function(data) {
                    $('#table').DataTable().ajax.reload();
                    swal.close();
                    $("#tanggal").html(data.tanggal);
                    loadingclose(data.pesan);
                },
                error: function(data) {
                    loadingclose('error');
                }
            });
        });

    });
</script>
@endsection