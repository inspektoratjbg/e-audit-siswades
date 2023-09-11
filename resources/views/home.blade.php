@extends('layouts.admin')
@section('title')
<h2>Dashboard</h2>
@endsection
@section('content')

<!-- Widgets -->
<div class="row clearfix">




    <!-- Answered Tickets -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-pink">
                <div class="font-bold m-b--35">10 Desa Paling beresiko</div>
                <ul class="dashboard-stat-list">
                    @foreach($top as $rt)
                    <li>
                        {{ str_replace('PEMERINTAH',' ', $rt->nama_desa) }}
                        <span class="pull-right"><b>{{ $rt->total }}</b> <small>POIN</small></span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Answered Tickets -->

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-cyan">
                <div class="font-bold m-b--35">10 Desa Paling tidak beresiko</div>
                <ul class="dashboard-stat-list">
                    @foreach($last as $rtl)
                    <li>
                        {{ str_replace('PEMERINTAH',' ', $rtl->nama_desa) }}
                        <span class="pull-right"><b>{{ $rtl->total }}</b> <small>POIN</small></span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

@endsection