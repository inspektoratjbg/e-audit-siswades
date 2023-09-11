<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ active_menu(['home','home/*']) }}">
            <a href="{{ url('/home') }}">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>

        <li class="{{ active_menu(['resiko','resiko/*']) }}">
            <a href="{{ url('/resiko') }}">
                <i class="material-icons">gavel</i>
                <span>Faktor Resiko Desa</span>
            </a>
        </li>
        <li class="{{ active_menu(['keuangan','keuangan/*']) }}">
            <a href="{{ url('/keuangan') }}">
                <i class="material-icons">library_books</i>
                <span>Ringkasan Keuangan</span>
            </a>
        </li>
        <li class="{{ active_menu(['apbdes','bop','belanjafisik','panjardd','pajak']) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">monetization_on</i>
                <span>Keuangan</span>
            </a>
            <ul class="ml-menu">
                <li class="{{ active_menu(['apbdes','apbdes/*']) }}">
                    <a href="{{ url('apbdes') }}">Penetapan APBDES</a>
                </li>
                <li class="{{ active_menu(['bop','bop/*']) }}">
                    <a href="{{ url('bop') }}">Proyeksi BOP</a>
                </li>
                <li class="{{ active_menu(['belanjafisik','belanjafisik/*']) }}">
                    <a href="{{ url('belanjafisik') }}">Upah Pekerja Belanja Fisik</a>
                </li>
                <li class="{{ active_menu(['panjardd','panjardd/*']) }}">
                    <a href="{{ url('panjardd') }}">Panjar DD Kegiatan Fisik</a>
                </li>
                <li class="{{ active_menu(['pajak','pajak/*']) }}">
                    <a href="{{ url('pajak') }}">Pajak</a>
                </li>
            </ul>
        </li>
        <li class="{{ active_menu(['pembinaan','pembinaan/*','pengawasan','pengawasan/*','pengaduan','pengaduan/*','perintah','perintah/*']) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">assignment</i>
                <span>Non Keuangan</span>
            </a>
            <ul class="ml-menu">
                <li class="{{ active_menu(['penilaian','penilaian/*']) }}">
                    <a href="{{ url('penilaian') }}">Pembinaan & Evaluasi kec</a>
                </li>
                <li class="{{ active_menu(['pembinaan','pembinaan/*']) }}">
                    <a href="{{ url('pembinaan') }}">Pembinaan Desa</a>
                </li>
                <li class="{{ active_menu(['pengawasan','pengawasan/*']) }}">
                    <a href="{{ url('pengawasan') }}">Pengawasan Desa</a>
                </li>
                <li class="{{ active_menu(['pengaduan','pengaduan/*']) }}">
                    <a href="{{ url('pengaduan') }}">Pengaduan Masyarakat</a>
                </li>
                <li class="{{ active_menu(['perintah','perintah/*']) }}">
                    <a href="{{ url('perintah') }}">Perintah Pengawasan</a>
                </li>
                <li class="{{ active_menu(['pembinaanevaluasi','pembinaanevaluasi/*']) }}">
                    <a href="{{ url('pembinaanevaluasi') }}">Pembinaan & evaluasi </a>
                </li>
                
            </ul>
        </li>
        <li class="{{ active_menu(['account','account/*','role','role/*','permission','permission/*']) }}">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">content_copy</i>
                <span>Sistem</span>
            </a>
            <ul class="ml-menu">
                <li class="{{ active_menu(['account','account/*']) }}">
                    <a href="{{ url('account') }}">Pengguna</a>
                </li>
                <li class="{{ active_menu(['role','role/*']) }}">
                    <a href="{{ url('role') }}">Role</a>
                </li>
                <li class="{{ active_menu(['permission','permission/*']) }}">
                    <a href="{{ url('permission') }}">Permission</a>
                </li>
            </ul>
        </li>
        <!-- <li class="header">KRITERIA</li> -->
        
    </ul>
</div>