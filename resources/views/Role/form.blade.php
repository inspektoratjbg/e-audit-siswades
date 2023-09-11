@extends('layouts.admin')
@section('title')
<h2>FORM ROLE</h2>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <form action="{{ $data['action'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field($data['method']) }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Role</label>
                                <div class="form-line">
                                    <input type="text" name="role" value="{{ $data['role']->name??'' }}" id="role" class="form-control" required placeholder="Nama role">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <label for="">Permission</label>
                            <div class="row">
                                @foreach($data['permission'] as $permission)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input @if(!empty($data['role'])) @if($data['role']->hasPermissionTo($permission)) checked @endif @endif type="checkbox" class="custom-control-input" name="permission[]" id="{{ $permission }}" value="{{ $permission }}">
                                            <label class="custom-control-label" for="{{ $permission }}">{{ $permission }}</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="material-icons">save</i> Simpan</button>
                        <a href="{{ url('role') }}" class="btn btn-warning"><i class="material-icons">flip_to_back</i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection