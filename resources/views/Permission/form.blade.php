@extends('layouts.admin')
@section('title')
<h2>FORM PERMISSIONS</h2>
@endsection
@section('content')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <form action="{{ $data['action'] }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field($data['method']) }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Permission</label>
                                <div class="form-line">
                                    <input type="text" name="permission" value="{{ $data['permission']->name??'' }}" id="permission" class="form-control" required>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-9">
                            <label for="">Role</label>
                            <div class="row">
                                @foreach($data['role'] as $role)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input @if(!empty($data['permission'])) @if($role->hasPermissionTo($data['permission']->name)) checked @endif @endif type="checkbox" class="custom-control-input" name="role[]" id="{{ $role->name }}" value="{{ $role->name }}">
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
                        <a href="{{ url('permission') }}" class="btn btn-warning"><i class="material-icons">flip_to_back</i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection