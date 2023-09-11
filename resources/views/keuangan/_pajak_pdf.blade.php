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

<h5 style="text-align: center;">RINGKASAN PAJAK T.A. {{ $TAHUN ?? '' }}<br>
    {{ $desa->Nama_Desa }}</h5>

<table border='1' cellspacing='0' cellpadding='3' width="100%">
    <thead>
        <tr>
            <th colspan="2">Pajak</th>
            <th>Pemotongan</th>
            <th>Penyetoran</th>
            <th>Saldo</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $rk)
        <tr>
            <td align="center">{{ $rk->kode }}</td>
            <td>{{ $rk->uraian }}</td>
            <td align="right">{{ formatAngka($rk->potongan,2) }}</td>
            <td align="right">{{ formatAngka($rk->setor,2) }}</td>
            <td align="right">{{ formatAngka($rk->saldo,2) }}</td>
            <td align="center">{{ formatAngka($rk->persen,2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<footer>
    Dicetak oleh aplikasi siswades Inspektorat Kab. Jombang {{ date('d M Y') }}
</footer>