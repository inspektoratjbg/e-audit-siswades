@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pegawai</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item active">Pegawai</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            List data
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('pegawai.create')}}" class="btn btn-xs btn-primary"><i class=" fas fa-plus-square"></i> Tambah</a>
                        </div>
                    </div>
                    <div class=" card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead class="bg-success text-white ">
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>Nama</th>
                                        <th>Divisi </th>
                                        <th>Email </th>
                                        <th>No Hp</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



@endsection
@section('script')
<script>
    $(document).ready(function() {
        // console.log("ready!");
        $('#table').DataTable({
            processing: true,
            serverSide: false,
            ordering: false,
            ajax: "{{ url('/pegawai') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'divisi',
                    name: 'divisi'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                }
            ],
            fnCreatedRow: function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }
        });
    });
</script>
@endsection