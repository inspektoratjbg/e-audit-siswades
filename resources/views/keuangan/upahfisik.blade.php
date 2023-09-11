@extends('layouts.admin')
@section('title')
<h2>BELANJA FISIK
    <div class="pull-right">
    </div>
</h2>

@endsection
@section('content')
<div class="row clearfix">
    <div id="form" class="col-xs-12 col-sm-4">
        <div class="card ">
            <div class="body">
                <form id="form_validation" action="#" method="get">
                    @csrf
                    <div class="form-group">
                        <div class="form-line">
                            <select id="tahun" name="tahun" class="form-control " required>
                                <?php for ($th = date('Y'); $th >=2020; $th--) { ?>
                                    <option value="{{ $th }}">{{ $th }}</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <select id="kd_kecamatan" name="kd_kecamatan" class="form-control show-tick" data-live-search="true" data-live-search-placeholder="Kecamatan" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <select id="kd_desa" name="kd_desa" class="form-control show-tick" data-live-search="true" data-live-search-placeholder="Desa" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <div class="demo-checkbox">
                                <input type="checkbox" id="perubahan" class="chk-col-red" />
                                <label for="perubahan">Anggaran Perubahan</label>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12">
        <div id="res"></div>
    </div>
</div>
@endsection
@section('css')
<!-- Bootstrap Select Css -->
<link href="{{ asset('bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
@section('script')
<script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('bsb/plugins/jquery-validation/jquery.validate.js')}}"></script>
<script>
    $(document).ready(function() {
        $("#back").click(function() {
            alert("Handler for .click() called.");
        });

        $("#form_validation").submit(function(e) {
            e.preventDefault();
            pak = 0;
            if ($('#perubahan').is(":checked")) {
                // it is checked
                pak = 1;
            }

            loading();
            $.ajax({
                // type: "POST",
                url: "{{ url('belanjafisik') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "kd_desa": $('#kd_desa').val(),
                    "pak": pak,
                    "tahun":$('#tahun').val()
                },
                success: function(data) {
                    swal.close();
                    $('#form').hide();
                    $('#res').show();
                    $('#res').html(data);
                },
                error: function(data) {
                    loadingclose('error');
                }
            });
        });



        loadKecamatan();
        // load option kecamatan
        function loadKecamatan() {
            $.ajax({
                url: "{{ url('kecamatan')}}",
                dataType: 'json',
                async: true,
                success: function(data) {
                    var html = '<option value=\"\" selected disabled>Kecamatan</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].Kd_Kec + '>' + data[i].Nama_Kecamatan + '</option>';
                    }
                    $("#kd_kecamatan").append(html);
                    $("#kd_kecamatan").val(4);
                    $("#kd_kecamatan").selectpicker("refresh");
                    $('#kd_kecamatan').selectpicker({
                        liveSearchPlaceholder: 'Kecamatan'
                    });
                }
            });
        };

        $('#kd_kecamatan').change(function() {
            kec = this.value;
            $.ajax({
                url: "{{ url('desa')}}?kd_kec=" + kec,
                dataType: 'json',
                async: true,
                success: function(data) {
                    var html = '<option value=\"\" selected disabled>Desa</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].Kd_Desa + '>' + data[i].Nama_Desa + '</option>';
                    }
                    $("#kd_desa").find('option').remove().end().append(html);
                    $("#kd_desa").selectpicker("refresh");
                    $('#kd_desa').selectpicker({
                        liveSearchPlaceholder: 'Desa'
                    });
                }
            });
        });

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