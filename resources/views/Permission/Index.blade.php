@extends('layouts.admin')
@section('title')
<h2>PERMISSIONS
    <div class="pull-right">
        <a href="{{ route('permission.create') }}" class="btn btn-xs btn-primary"><i class="material-icons">note_add</i> Tambah</a>
    </div>
</h2>
@endsection
@section('content')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class=" body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead class="bg-success text-white ">
                            <tr>
                                <th width="10px">No</th>
                                <th>Permission Name</th>
                                <th>Role </th>
                                <th width="120px"></th>
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
            serverSide: false,
            ordering: false,
            ajax: "{{ url('/permission') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'guard_name',
                    name: 'guard_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },

            ],
            fnCreatedRow: function(row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }

        });
    });
</script>
@endsection