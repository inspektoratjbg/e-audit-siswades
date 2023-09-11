<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Http\Requests\PembinaanRequest;
use App\Imports\PembinaanEvaluasImport;
use App\PembinaanEvaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class pembinaanevaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = PembinaanEvaluasi::with('Desa')->where('tahun',date('Y'));
            return DataTables::of($data)

                ->addColumn('desa', function ($data) {
                    return optional($data->Desa)->Nama_Desa;
                })
                ->addColumn('kecamatan', function ($data) {
                    return optional($data->Desa)->kecamatan->Nama_Kecamatan;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('pembinaanevaluasi.edit', $data->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                    $btn .= '<a href="#"   data-url="' . route('pembinaanevaluasi.hapus', $data->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'desa', 'kecamatan'])
                ->make(true);
        }
        return view('pembinaanevaluasi.index');
    }

    public function create()
    {
        //
        $data = [
            'action' => route('pembinaanevaluasi.store'),
            'method' => 'POST',
            'desa' => Desa::get()
        ];
        return view('pembinaanevaluasi.form', \compact('data'));
        // dd($data['desa'][0]->kecamatan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembinaanRequest $request)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);

            $fd = PembinaanEvaluasi::where('kd_desa', $request->kd_desa)->where('tahun', $request->tahun);
            if ($fd->count() > 0) {
                //   update
                $fd->update($data);
            } else {
                //    insert
                PembinaanEvaluasi::create($data);
            }

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            $pesan = "Data berhasil di simpan";
            $type = "success";
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $pesan = $e->getMessage();
            $type = "warning";
        }

        return redirect('pembinaanevaluasi')->with(['status' => $pesan, 'type' => $type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pembinaan = PembinaanEvaluasi::find($id);
        $data = [
            'action' => route('pembinaanevaluasi.update', $id),
            'method' => 'PATCH',
            'desa' => Desa::get(),
            'res' => $pembinaan
        ];
        return view('pembinaanevaluasi.form', \compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PembinaanRequest $request, $id)
    {
        //
        // Begin Transaction
        DB::beginTransaction();
        try {
            $pembinaan = PembinaanEvaluasi::find($id);
            $data = $request->except(['_token', '_method']);
            $pembinaan->update($data);
            DB::commit();
            // Semua proses benar
            $pesan = "Data berhasil di update";
            $type = "success";
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            // ada yang error
            $pesan = $e->getMessage();
            $type = "warning";
        }

        return redirect('pembinaanevaluasi')->with(['status' => $pesan, 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pembinaan = PembinaanEvaluasi::find($id);
        $pembinaan->delete();
        return redirect('pembinaanevaluasi')->with(['status' => 'Berhasil hapus data', 'type' => 'success']);
    }

    public function uploadData(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        // menangkap file excel
        $file = $request->file('file');
        $res = Excel::import(new PembinaanEvaluasImport, $file);
        dd($res);
    }
}
