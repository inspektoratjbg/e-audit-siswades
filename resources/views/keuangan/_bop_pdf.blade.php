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
<h5 style="text-align: center;">KOMPOSISIS BELANJA APBDES T.A. {{ $tahun }}<br>{{ $desa->Nama_Desa }}<br>Status : {{ $status }}</h5>
<table border='1' cellspacing='0' width="100%">
    <thead>
        <tr>
            <th rowspan="2">Uraian </th>
            <th>Total Belanja </th>
            <th colspan="2">BOP </th>
            <th colspan="2">Non BOP</th>
        </tr>
        <tr>
            <th> Rupiah</th>
            <th> Rupiah</th>
            <th>% </th>
            <th>Rupiah</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        @php
        $bop=0;
        $nonbop=0;
        @endphp

        @foreach($data as $data)
        <tr>
            <td>{{ $data->kode }} {{ $data->jenis_belanja }}</td>
            <td align="right">{{ formatAngka($data->jumlah,2) }}</td>
            <td align="right">{{ formatAngka($data->jumlah_bop,2) }}</td>
            <td align="center">{{ formatAngka($data->persen_bop,2) }}%</td>
            <td align="right">{{ formatAngka($data->jumlah_non_bop,2) }}</td>
            <td align="center">{{ formatAngka($data->persen_non_bop,2) }}%</td>

        </tr>
        @if($data->kode=='')
        @php
        $bop=formatAngka($data->persen_bop,2);
        $nonbop=formatAngka($data->persen_non_bop,2);
        @endphp
        @endif
        @endforeach
        <tr>
            <td rowspan="2" colspan="3">Batas maksimal Biaya Operasional adalah 30% dari total belanja desa.</td>
            <td colspan="3">Komposisi Belanja Operasional <b>{{ $bop }}%</b></td>
        </tr>
        <tr>
            <td colspan="3">Komposisi Belanja Non Operasional <b>{{ $nonbop }}%</b></td>
        </tr>
    </tbody>
</table>
<footer>
    Dicetak oleh aplikasi siswades Inspektorat Kab. Jombang {{ date('d M Y') }}
</footer>