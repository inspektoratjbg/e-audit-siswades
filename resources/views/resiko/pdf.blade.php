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
<h5 style="text-align: center;">INSPEKTORAT KABUPATEN JOMBANG<br>FAKTOR RESIKO DESA 2021<br>TAHUN PEMERIKSAAN 2022</h5>
<table border='1' cellspacing='0' width="100%" cellpadding=3>
    <thead>
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>V1</th>
            <th>V2</th>
            <th>V3</th>
            <th>V4</th>
            <th>V5</th>
            <th>V6</th>
            <th>V7</th>
            <th>V8</th>
            <th>V9</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1; @endphp
        @foreach($desa as $rd)
        <tr>
            <td align="center">{{ $no }}</td>
            <td>{{ $rd->Nama_Kecamatan }}</td>
            <td>{{ $rd->nama_desa }}</td>
            <td align="center">{{ $rd->v1 }}</td>
            <td align="center">{{ $rd->v2 }}</td>
            <td align="center">{{ $rd->v3 }}</td>
            <td align="center">{{ $rd->v4 }}</td>
            <td align="center">{{ $rd->v5 }}</td>
            <td align="center">{{ $rd->v6 }}</td>
            <td align="center">{{ $rd->v7 }}</td>
            <td align="center">{{ $rd->v8 }}</td>
            <td align="center">{{ $rd->v9 }}</td>
            <td align="center">{{ $rd->total }}</td>
        </tr>
        @php $no++; @endphp
        @endforeach
    </tbody>
</table>

<table width="100%">

    <tr style="border:1px solid #fff;">

        <td style="border:1px solid #fff;" width="70%">
            <p style="color: white;">.</p>
            <ul>
                <li>
                    <span>V1: Penetapan APBDES</span>
                </li>
                <li>
                    <span>V2: BOP</span>
                </li>
                <li>
                    <span>V3: Upah Pekerja</span>
                </li>
                <li>
                    <span>V4: Panjar DD</span>
                </li>
                <li>
                    <span>V5: Pajak</span>
                </li>
                <li>
                    <span>V6: Pembinaan</span>
                </li>
                    <span>V7: Pengawasan</span>
                </li>
                <li>
                    <span>V8: Pengaduan Masyarakat</span>
                </li>
                <li>
                    <span>V9: Penilaian Kecamatan</span>
            </ul>
        </td>
        <td style="border:1px solid #fff;" width="30%">
            <P>Jombang, 20 Desember 2022 <br> Inspektorat Kabupaten Jombang</p><br><br><br><br>
            <p><u>Abdul Madjid Nindyagung, SH., M.Si. </u><br>Pembina Tingkat I <br>NIP. 19670105 199212 1 001</p>

        </td>
    </tr>

</table>


<footer>
    Dicetak oleh aplikasi siswades Inspektorat Kab. Jombang {{ date('d M Y') }}
</footer>