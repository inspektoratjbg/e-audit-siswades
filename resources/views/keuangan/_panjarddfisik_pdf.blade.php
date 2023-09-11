<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }

    /** Define the margins of your page **/
    @page {
        margin: 25px 25px;
    }

    header {
        position: fixed;
        /* top: -60px; */
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 35px;
    }

    footer {
        position: fixed;
        bottom: -20px;
        left: 0px;
        right: 0px;
        height: 30px;

        /** Extra personal styles **/
        background-color: grey;
        color: white;
        text-align: center;
        line-height: 30px;
    }
</style>

<h5 style="text-align: center;">SPP PANJAR DANA DESA {{ $tahun }}<br>
    KEGIATAN BELANJA FISIK<br>
    {{ $desa->Nama_Desa }}</h5>

<table border='1' cellspacing='0' width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>SPP</th>
            <th>Kegiatan</th>
            <th>Pagu</th>
            <th>Panjar</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($data as $rk)
        <tr>
            <td align="center">{{ $no }}</td>
            <td>
                {{ $rk->no_spp }}
                <br> <small class="col-pink"> {{ tanggal_indonesia($rk->tgl_spp) }}</small>
            </td>
            <td>
                {{ $rk->nama_kegiatan }}
                <br> <small class="col-pink"> {{ $rk->kd_keg }}</small>
            </td>
            <td align="right">{{ formatAngka($rk->pagu,2) }}</td>
            <td align="right">{{ formatAngka($rk->panjar,2) }}</td>
        </tr>
        @php $no++; @endphp
        @endforeach
        <tr>
            <td rowspan="3" colspan="2"> </td>
            <th align="right">Pagu</th>
            <td colspan="2" align="right">{{ formatAngka($total->pagu,2) }}</td>
        </tr>
        <tr>
            <th align="right">Panjar</th>
            <td colspan="2" align="right"> {{ formatAngka($total->panjar,2) }}</td>
        </tr>
        <tr>
            <th align="right">Persentase</th>
            <td colspan="2" align="right"> {{ formatAngka($total->persen,2) }}%</td>
        </tr>
    </tbody>
</table>
<footer>
    Dicetak oleh aplikasi siswades Inspektorat Kab. Jombang {{ date('d M Y') }}
</footer>