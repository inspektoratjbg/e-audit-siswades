<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PenilaianRequest;
use App\PenilaianKecamatan;
use App\Imports\penilaianImport;
use Yajra\Datatables\Datatables;
use App\Desa;
use DB;
use Excel;

class penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PenilaianKecamatan::with('Desa')->where('tahun',2021);
            return Datatables::of($data)

                ->addColumn('desa', function ($data) {
                    return optional($data->Desa)->Nama_Desa;
                })
                ->addColumn('kecamatan', function ($data) {
                    return optional($data->Desa)->kecamatan->Nama_Kecamatan;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('penilaian.edit', $data->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                    $btn .= '<a href="#"   data-url="' . route('penilaian.hapus', $data->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'desa', 'kecamatan'])
                ->make(true);
        }
        return view('penilaian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'action' => route('penilaian.store'),
            'method' => 'POST',
            'desa' => Desa::get()
        ];
        return view('penilaian.form', \compact('data'));
        // dd($data['desa'][0]->kecamatan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenilaianRequest $request)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);

            $fd = PenilaianKecamatan::where('kd_desa', $request->kd_desa)->where('tahun', 2021);
            if ($fd->count() > 0) {
                //   update
                $fd->update($data);
            } else {
                //    insert
                PenilaianKecamatan::create($data);
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

        return redirect('penilaian')->with(['status' => $pesan, 'type' => $type]);
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
        $penilaian = PenilaianKecamatan::find($id);
        $data = [
            'action' => route('penilaian.update', $id),
            'method' => 'PATCH',
            'desa' => Desa::get(),
            'res' => $penilaian
        ];
        return view('penilaian.form', \compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenilaianRequest $request, $id)
    {
        //
        // Begin Transaction
        DB::beginTransaction();
        try {
            $penilaian = PenilaianKecamatan::find($id);
            $data = $request->except(['_token', '_method']);
            $penilaian->update($data);
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

        return redirect('penilaian')->with(['status' => $pesan, 'type' => $type]);
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
        $penilaian = PenilaianKecamatan::find($id);
        $penilaian->delete();
        return redirect('penilaian')->with(['status' => 'Berhasil hapus data', 'type' => 'success']);
    }

    public function uploadData(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        // menangkap file excel
        $file = $request->file('file');
        $res = Excel::import(new penilaianImport, $file);
        dd($res);
    }
}
