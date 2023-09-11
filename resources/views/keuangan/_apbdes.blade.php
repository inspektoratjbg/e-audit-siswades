<div class="card ">

    <div class="body">
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right"><button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button></div>
            </div>
            <div class="col-xs-12">
                <h5 class='font-bold text-center'>PENETAPAN ANGGARAN DESA T.A. {{ $tahun }}</h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">email</i>
                    </div>
                    <div class="content">
                        <div class="text">USULAN</div>
                        <div class="text">{{ tanggal_indonesia($data->usulan)}}</div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="content">
                        <div class="text">ANGGARAN  </div>
                        <div class="text">{{ tanggal_indonesia($data->anggaran_awal)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-indigo hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">chrome_reader_mode</i>
                    </div>
                    <div class="content">
                        <div class="text">PERUBAHAN  </div>
                        <div class="text">{{ tanggal_indonesia($data->anggaran_pak)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">description</i>
                    </div>
                    <div class="content">
                        <div class="text">PERKADES  </div>
                        <div class="text">{{ tanggal_indonesia($data->perkades)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#back").click(function() {
            $('#form').show();
            $('#res').hide();
        });
    });
</script>