@extends('layouts.admin')

@section('title')
<h2>ASSIGN ROLE</h2>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form action="{{ $data['action'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field($data['method']) }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $data['user']->name??'' }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ $data['user']->email??'' }}" class="form-control" readonly>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <label for="">Role</label>
                            <div class="row">

                                @foreach($data['role'] as $role)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input @if(in_array($role->name,$data['ar'])) checked @endif type="checkbox" class="custom-control-input" name="role[]" id="{{ $role->name }}" value="{{ $role->name }}">
                                            <label class="custom-control-label" for="{{ $role->name }}">{{ $role->name }}</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="material-icons">save</i> Simpan</button>
                        <a href="{{ url('account') }}" class="btn btn-warning"><i class="material-icons">flip_to_back</i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection