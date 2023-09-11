<div class="card ">
    <div class="body">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right"><button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button></div>
            </div>
            <div class="col-md-12">
                <h5 class='font-bold text-center'>RINGKASAN KEUANGAN T.A. {{ $tahun }} </h5>
                <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
            </div>
        </div>



        <br>
        <table class="table">
            <tbody>
                @foreach($result as $row)
                <tr>
                    <td align="right"><b>{{ $row->label_a }}</b></td>
                    <td align="left">{{ $row->label_b }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td align="right">{{ formatAngka($row->nilai,2) }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>


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