@extends('layouts.admin')
@section('title')
<h2>PERINTAH PEMERIKSAAN DESA
    <div class="pull-right">
        <a href="{{ route('perintah.create')}}" class="btn btn-xs btn-primary"><i class="material-icons">note_add</i> Tambah</a>
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
                                <th>Desa</th>
                                <th>Keterangan</th>
                                <th>Action</th>
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
            ordering: false,
            serverSide: false,
            ajax: "{{ url('/perintah') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    classname: 'text-center'
                }, {
                    data: 'desa',
                    name: 'desa',
                    render: function(data, type, row) {
                        var res = data;
                        if (row.kecamatan != null) {
                            res += '<br><code>' + row.kecamatan + '</code>';
                        }

                        return res;
                    }
                },
                {
                    data: 'keterangan_permintaan',
                    name: 'keterangan_permintaan',
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-right'
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

        $('#table').on('click', '.selesai', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: $(this).data('desa')+" Sudah di lakukan pengawasan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, selesai!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = $(this).data('url');
                }
            })

        });
    });
</script>
@endsection