
<div class="card ">
    <div class="body">
        <span class="pull-right"><button id="back" class="btn btn-xs btn-info"> <i class="material-icons">close</i></button></span>
        <h5 class='font-bold text-center'>RINGKASAN KEUANGAN  </h5>
        <h6 class='text-center col-teal'>{{ $desa->Nama_Desa }}</h6>
        
  
<br>
<table cellspacing="0" cellpadding="0" style="font-size:14px" border="0" width=0>
    <tr>
        <td width="10px">I</td>
        <td colspan="6">Register SPP dan Kuitansi </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Register SPP</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  width="10%" align="right"> {{ formatAngka($spp,2)}} </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Register Kuitansi</td>
        <td  width="10px">:</td>
        <td  style=" border-bottom:1pt solid black;" width="10px">Rp</td>
        <td  style=" border-bottom:1pt solid black;" width="10%" align="right">
            {{ formatAngka($kuitansi,2)}} </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >Selisih</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right">{{ formatAngka($spp - $kuitansi,2)}} </td>
    </tr>
    <tr>
        <td  width="10px">1)</td>
        <td  colspan="6">Anggaran, Realisasi dan Sisa Anggaran Tahun {{date('Y')}}.</td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">a)</td>
        <td  width="10px" colspan="5">Pendapatan (Anggaran Pendapatan di APBDes)</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Anggaran Pendapatan Tahun {{date('Y')}}</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($pendapatan_anggaran,2)}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >(Anggaran Pendapatan di APBDesa) </td>
        <td  width="10px"></td>
        <td  width="10px"></td>
        <td ></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Real. Pendapatan s/d Pemeriksaan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka($pendapatan_realisasi,2,',','.')}}</u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >(Berdasarkan LRA) </td>
        <td  width="10px"></td>
        <td  width="10px"></td>
        <td ></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Kurang Realisasi</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($pendapatan_anggaran   - $pendapatan_realisasi,2,',','.')}} </td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">b)</td>
        <td  width="10px" colspan="5">Belanja (Anggaran Belanja di APBDesa). </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Anggaran Belanja Tahun {{date('Y')}}</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($belanja_anggaran,2)}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >(Anggaran Belanja di APBDesa) </td>
        <td  width="10px"></td>
        <td  width="10px"></td>
        <td ></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Real. Belanja s/d Pemeriksaan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u>  {{ formatAngka($belanja_realisasi,2)}} </u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >(Berdasarkan LRA) </td>
        <td  width="10px"></td>
        <td  width="10px"></td>
        <td ></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Kurang Belanja</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right">  {{ formatAngka( $belanja_anggaran -  $belanja_realisasi,2)}}  </td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">c)</td>
        <td  width="10px" colspan="5">Surplus/Defisit Pendapatan dan Belanja sampai dengan pemeriksaan </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Realisasi Pendapatan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($pendapatan_realisasi,2,',','.')}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Realisasi Belanja</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka($belanja_realisasi,2,',','.')}} </u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Surplus</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> @php  $surplus=$pendapatan_realisasi - $belanja_realisasi;  echo  formatAngka($surplus,2,',','.') @endphp </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td >(Berdasarkan LRA) </td>
        <td  width="10px"></td>
        <td  width="10px"></td>
        <td ></td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">d)</td>
        <td  width="10px" colspan="5">Pembiayaan </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >SILPA Tahun Lalu</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right">  {{ formatAngka($silpa_tahun_lalu ,2,',','.')}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Penerimaan Pembiayaan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right" style=" border-bottom:1pt solid black;">  {{ formatAngka($pembiayaan_penerimaan ,2,',','.')}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px"></td>
        <td ></td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right">  {{ formatAngka($silpa_tahun_lalu - $pembiayaan_penerimaan ,2,',','.')}}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Pengeluaran Pembiayaan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right" style=" border-bottom:1pt solid black;">  <?php $cvb=$pembiayaan_penerimaan; echo formatAngka($cvb ,2,',','.') ?></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Pembiayaan Netto</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <?php $netto=($silpa_tahun_lalu - $pembiayaan_penerimaan) + $cvb;  if($netto<0){ echo  '('.formatAngka(abs($netto) ,2,',','.').')'; }else{ echo formatAngka(abs($netto) ,2,',','.'); }  ?></td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">e)</td>
        <td  width="10px" colspan="5">SILPA Tahun Ini </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Surplus</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($surplus,2,',','.') }} </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Pembiayaan Netto</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka($netto,2,',','.') }}</u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >SILPA</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($netto+$surplus,2,',','.') }}</td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td  width="10px">2)</td>
        <td  colspan="6">Penutupan Buku Kas Umum  per tanggal pemeriksaan ( {{ date('d / m / Y ')}} )</td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">a)</td>
        <td  width="10px" colspan="5">Buku pembantu kas </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Penerimaan *)</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($kas_tunai_penerimaan,2,',','.') }}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Pengeluaran *)</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka($kas_tunai_pengeluaran,2,',','.') }} </u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Saldo Kas Tunai</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <?php $saldo_tunai=$kas_tunai_penerimaan - $kas_tunai_pengeluaran; echo formatAngka( $saldo_tunai,2,',','.') ?> </td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">b)</td>
        <td  width="10px" colspan="5">Buku Pembantu Bank </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Penerimaan *)</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka($kas_bank_penerimaan,2,',','.') }}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Pengeluaran *)</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka($kas_bank_pengeluaran,2,',','.') }}</u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Saldo Kas Di Bank</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <?php $saldo_bank=$kas_bank_penerimaan - $kas_bank_pengeluaran; echo formatAngka( $saldo_bank,2,',','.') ?> </td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px" colspan="5">*) Termasuk transaksi pungutan/setoran pajak</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px" colspan="5">**) Termasuk Bunga Bank </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px" colspan="5">***) Termasuk Pajak dan Admin Bank </td>
    </tr>
    <tr>
        <td  height='20px'></td>
    </tr>
    <tr>
        <td ></td>
        <td  width="10px">c)</td>
        <td  width="10px" colspan="5">Buku Kas Umum </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Jumlah Penerimaan</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka( $kas_tunai_penerimaan + $kas_bank_penerimaan ,2,',','.') }}</td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Jumlah Pengeluaran</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> <u> {{ formatAngka( $kas_tunai_pengeluaran + $kas_bank_pengeluaran ,2,',','.') }} </u></td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Saldo Kas</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka( ($kas_tunai_penerimaan + $kas_bank_penerimaan) - ($kas_tunai_pengeluaran + $kas_bank_pengeluaran) ,2,',','.') }} </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Saldo Kas Tunai</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka( $saldo_tunai,2,',','.') }} </td>
    </tr>
    <tr>
        <td  colspan="2"></td>
        <td  width="10px">-</td>
        <td >Saldo Kas Di Bank</td>
        <td  width="10px">:</td>
        <td  width="10px">Rp</td>
        <td  align="right"> {{ formatAngka( $saldo_bank,2,',','.') }} </td>
    </tr>

    <tr>
        <td height='20px'></td>
    </tr>
    <tr>
        <td width="10px">3)</td>
        <td colspan="6">Surat Pertanggung Jawaban ( SPJ ) (sesuai LRA) : </td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Jumlah pengeluaran (LRA) </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> {{ formatAngka($belanja_realisasi,2)}}</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Telah dipertanggungjawabkan / SPJ (Kuitansi)
        </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> <u> {{ formatAngka($kuitansi,2)}} </u></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Sisa yang belum di SPJ kan </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> {{ formatAngka(abs($belanja_realisasi- $kuitansi),2)}} </td>
    </tr>    <tr>
        <td height='20px'></td>
    </tr>
    <tr>
        <td width="10px">4)</td>
        <td colspan="6">Penerimaan PPN / PPh Tahun {{date('Y')}}					 </td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Penerimaan	 </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> {{ formatAngka(abs($pphterima),2)}}</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Penyetoran       </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> <u>  {{ formatAngka($pphsetor,2)}} </u></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Sisa Belum Disetor	 </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right">  {{ formatAngka(abs($pphterima-$pphsetor),2)}} </td>
    </tr>    <tr>
        <td height='20px'></td>
    </tr>
    <tr>
        <td width="10px">5)</td>
        <td colspan="6">Penerimaan Pajak Daerah (Pajak Restoran) Tahun {{date('Y')}}</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Penerimaan	 </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> {{ formatAngka(abs($ppdterima),2)}}</td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Penyetoran       </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right"> <u>  {{ formatAngka($ppdsetor,2)}} </u></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td width="10px">-</td>
        <td>Sisa Belum Disetor	 </td>
        <td width="10px">:</td>
        <td width="10px">Rp</td>
        <td align="right">  {{ formatAngka(abs($ppdterima-$ppdsetor),2)}} </td>
    </tr>
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