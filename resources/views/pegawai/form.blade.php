@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('pegawai') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
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
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            Form {{$title}}
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                        @endif

                        <form action="{{ $data['action'] }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field($data['method']) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" id="nama" value="{{ $data['pegawai']->nama??old('nama') }}" class="form-control {{ $errors->has('nama') ? 'is-invalid' : ''}}">
                                                <span class="error invalid-feedback"> {{ $errors->first('nama') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Divisi</label>
                                                <input type="text" name="divisi" id="divisi" value="{{ $data['pegawai']->divisi??old('divisi') }}" class="form-control {{ $errors->has('divisi') ? 'is-invalid' : ''}}">
                                                <span class="error invalid-feedback"> {{ $errors->first('divisi') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No Telepon</label>
                                                <input type="text" name="no_hp" id="no_hp" value="{{ $data['pegawai']->no_hp??old('no_hp') }}" class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : ''}}">
                                                <span class="error invalid-feedback"> {{ $errors->first('no_hp') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" id="email" value="{{ $data['pegawai']->email??old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}">
                                                <span class="error invalid-feedback"> {{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    </div>



                                    @if($data['method']=='POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : ''}}" value="{{ old('new_password') }}">
                                                <span class="error invalid-feedback"> {{ $errors->first('new_password') }}</span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password_confirm" id="password_confirm" class="form-control {{ $errors->has('password_confirm') ? 'is-invalid' : ''}}" value="{{ old('password_confirm') }}">
                                                <span class="error invalid-feedback"> {{ $errors->first('password_confirm') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assign Role</label>
                                        @if($errors->has('role')==1)
                                        <br><small style="color:red;"> {{ $errors->first('role') }}</small>
                                        @endif
                                        <div class="row">

                                            @foreach($data['role'] as $roles)
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input @if(in_array($roles->name,$data['ar'])) checked @endif @if(is_array(old('role')) && in_array($roles->name, old('role'))) checked @endif class="custom-control-input" name="role[]" type="checkbox" id="{{ $roles->name }}" value="{{ $roles->name }}">
                                                    <label for="{{ $roles->name }}" class="custom-control-label">{{ $roles->name }}</label>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="float-sm-right">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection