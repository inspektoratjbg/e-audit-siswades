@extends('layouts.admin')
@section('title')
<h2>Pengguna</h2>
@endsection
@section('content')
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="table">
                        <thead class="bg-success text-white ">
                            <tr>
                                <th width="10px">No</th>
                                <th>Nama</th>
                                <th>Email </th>
                                <th>Roles </th>
                                <th></th>
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
            // dom: 'Bfrtip',
            responsive: true,
            processing: true,
            serverSide: false,
            ordering: false,
            ajax: "{{ url('/account') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'roles',
                    name: 'roles'
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