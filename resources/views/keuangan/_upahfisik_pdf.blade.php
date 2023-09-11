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

<h5 style="text-align: center;">KOMPOSISI BELANJA FISIK APBDES {{ $tahun }}<br>{{ $desa->Nama_Desa }}<br>Status : {{ $status }}</h5>
<table border='1' cellspacing='0' width="100%">
    <thead>
        <tr>
            <th rowspan="2">Uraian </th>
            <th>Total Belanja </th>
            <th colspan="2">Upah </th>
            <th colspan="2">Non Upah </th>
        </tr>
        <tr>
            <th> Rupiah</th>
            <th> Rupiah</th>
            <th>% </th>
            <th> Rupiah</th>
            <th>% </th>
        </tr>
    </thead>
    <tbody>
        @php
        $bop=0;
        $nonbop=0;
        @endphp

        @foreach($data as $data)
        <tr>
            <td>{{ $data->jenis }} {{ $data->nama_jenis }}</td>
            <td style="text-align: right;">{{ formatAngka($pak==1?$data->jumlah_pak:$data->jumlah,2) }}</td>
            <td style="text-align: right;">{{ formatAngka($pak==1?$data->upah_pak:$data->upah,2) }}</td>
            <td style="text-align:center">{{ formatAngka($pak==1?$data->persen_pak:$data->persen,2) }}%</td>
            <td style="text-align: right;">{{ formatAngka(($pak==1?$data->jumlah_pak:$data->jumlah) -  ($pak==1?$data->upah_pak:$data->upah),2) }}</td>
            <td style="text-align:center">{{ formatAngka(100 - ($pak==1?$data->persen_pak:$data->persen) ,2) }}%</td>
        </tr>
        @if($data->jenis=='')
        @php
        $bop=formatAngka($pak==1?$data->persen_pak:$data->persen,2);
        $nonbop=formatAngka(100 - ($pak==1?$data->persen_pak:$data->persen),2);
        @endphp
        @endif
        @endforeach
        <tr>
            <td rowspan="2" colspan="3"></td>
            <td colspan="3">Komposisi Upah Pekerja <b>{{ $bop }}%</b></td>
        </tr>
        <tr>
            <td colspan="3">Komposisi Non Upah Pekerja <b>{{ $nonbop }}%</b></td>
        </tr>
    </tbody>
</table>
<footer>
    Dicetak oleh aplikasi siswades Inspektorat Kab. Jombang {{ date('d M Y') }}
</footer>