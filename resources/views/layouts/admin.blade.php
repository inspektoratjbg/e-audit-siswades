<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('bsb/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset('bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ asset('bsb/css/style.css') }}" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('bsb/css/themes/all-themes.css') }}" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="theme-red">

    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a style="padding:0;" class="navbar-brand" href="{{ url('/') }}"><img style="height: 50px;" src="{{ url('logo.png') }}" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('bsb/images/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('auth.change_password') }}"><i class="material-icons">person</i>Ubah Password</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="material-icons">exit_to_app</i> Logout</a>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            @include('layouts.menu')
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    <!-- &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>. -->
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">

                <div id="status" date-type="{{ session('type') }}" data-value="{{ session('status') }}"></div>
                @yield('title')
            </div>
            @yield('content')
        </div>
    </section>

    <div id="notifikasi" data-type="{{ session('type') }}" data-msg="{{ session('status') }}"></div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('bsb/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('bsb/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Select Plugin Js -->
    <script src="{{ asset('bsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('bsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('bsb/plugins/node-waves/waves.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('bsb/js/admin.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('bsb/js/demo.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('bsb/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var flashdata = $('#flashdata').data('pesan');
        // notifikasi flashdata
        if (flashdata) {
            toastr.error(flashdata);
        }
        // loading
        function loading() {
            url = "{{ asset('loading.gif') }}";
            swal.fire({
                imageUrl: url,
                text: "Sedang memproses...",
                showConfirmButton: false,
                allowOutsideClick: false
            });
        }

        function loadingclose(vtext) {
            swal.fire({
                type: 'warning',
                text: vtext,
                timer: 1500,
                showConfirmButton: false,
                allowOutsideClick: false
            });
        }



        // hapus data 
        $('#table').on('click', '.hapus', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak akan dapat mengembalikanya!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = $(this).data('url');
                }
            })

        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
    @yield('script')
</body>

</html>