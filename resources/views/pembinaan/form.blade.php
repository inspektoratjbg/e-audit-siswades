@extends('layouts.admin')
@section('title')
<h2>FORM PEMBINAAN PENGELOLAAN KEUANGAN DESA</h2>
@endsection
@section('content')

<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="body">
                <form action="{{ $data['action'] }}" id="form_validation" method="POST">
                    {{ csrf_field() }}
                    {{ method_field($data['method']) }}


                    <div class="form-group form-float">
                        <div class="form-line {{  $errors->has('tahun')?'error':'' }}">
                            {{-- <input type="text" name="tahun" id="tahun" class="form-control" required value="{{ $data['res']->tahun??old('tahun')??date('Y') }}" readonly> --}}

                            <select id="tahun" name="tahun" class="form-control " required>
                                <?php for ($th = date('Y'); $th >=2020; $th--) { ?>
                                    <option @if(($data['res']->tahun??old('tahun')??date('Y'))==$th ) selected @endif value="{{ $th }}">{{ $th }}</option>
                                <?php } ?>
                            </select>
                            <label class="form-label">Tahun</label>
                        </div>
                        <label class="error">{{ $errors->first('tahun') }}</label>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{  $errors->has('kd_desa')?'error':'' }}">

                            <select name="kd_desa" id="kd_desa" class="form-control show-tick" data-live-search="true" required>
                                <option value="">Desa</option>
                                @php
                                $selected=old('kd_desa');
                                if(isset($data['res']->kd_desa)){
                                $selected=$data['res']->kd_desa;
                                }
                                @endphp
                                @foreach($data['desa'] as $desa)
                                <option @if($selected==$desa->Kd_Desa) selected @endif value="{{ $desa->Kd_Desa }}">{{ $desa->Nama_Desa }}, {{ $desa->kecamatan->Nama_Kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="error">{{ $errors->first('kd_desa') }}</label>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{  $errors->has('jumlah')?'error':'' }}">
                            <input type="text" name="jumlah" id="jumlah" class="form-control" required value="{{ $data['res']->jumlah??old('jumlah') }}">
                            <label class="form-label">Resiko</label>
                        </div>
                        <label class="error">{{ $errors->first('jumlah') }}</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="material-icons">save</i> Simpan</button>
                        <a href="{{ url('pembinaan') }}" class="btn btn-warning"><i class="material-icons">flip_to_back</i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('css')
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
@section('script')
<!-- Select Plugin Js -->
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#form_validation').validate({
            rules: {
                'checkbox': {
                    required: true
                },
                'gender': {
                    required: true
                }
            },
            highlight: function(input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function(input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function(error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
    });
</script>
@endsection