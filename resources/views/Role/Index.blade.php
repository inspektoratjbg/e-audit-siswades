@extends('layouts.admin')
@section('title')
<h2>ROLE
    <div class="pull-right">
        @if(userCan('role.create'))
        <a href="{{ route('role.create')}}" class="btn btn-sm btn-primary"><i class="material-icons">note_add</i> Tambah</a>
        @endif
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
                                <th width="10px">No</th>
                                <th>Role</th>
                                <th>Permission </th>
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
            ordering: false,
            serverSide: false,
            ajax: "{{ url('/role') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'permission',
                    name: 'permission',
                    orderable: false,
                    searchable: false,
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