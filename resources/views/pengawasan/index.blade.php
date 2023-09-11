@extends('layouts.admin')
@section('title')
<h2>PENGAWASAN PENGELOLAAN KEUANGAN DESA
    <div class="pull-right">
        <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-default"><i class="material-icons">cloud_upload</i> Upload</a>
        <a href="{{ route('pengawasan.create')}}" class="btn btn-xs btn-primary"><i class="material-icons">note_add</i> Tambah</a>
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
                                <th>Resiko</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="tagForm" id="tag-form" action="{{ route('pengawasan.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Upload Berkas Excel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tutorial:</label>
                        <ol>
                            <li>Isi data pada template yang sudah di sediakan</li>
                            <li>Template dapat di unduh dengan cara klik tombol "Template"</li>
                            <li>kolom <b>"KODE"</b> di isi dengan kode desa siskeudes</li>
                            <li>kolom <b>"NILAI"</b> di isi dengan nilai resiko</li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ asset('template_upload.xlsx') }}" class="btn btn-default"><i class="material-icons">attach_file</i> Template</a>
                    <button type="submit" id="tag-form-submit" class="btn btn-primary"><i class="material-icons">cloud_upload</i> Upload</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
            ajax: "{{ url('/pengawasan') }}",
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
                    data: 'jumlah',
                    name: 'jumlah',
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

        $('#tag-form-submit').on('click', function(e) {
            e.preventDefault();
            loading();


            var data = new FormData(this.form);
            $.ajax({
                type: "POST",
                url: "{{ route('pengawasan.upload') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    // alert(response['response']);
                    swal.close();
                    $('#modal-default').modal('hide');
                    // toastr.success('Dokumen berhasil di import');
                    loadingclose('Dokumen berhasil di import');
                    $('#table').DataTable().ajax.reload();
                },
                error: function() {
                    // alert('Error');
                    loadingclose('error');
                }
            });
            return false;
        });
    });
</script>
@endsection