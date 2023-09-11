<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PengawasanRequest;
use Yajra\Datatables\Datatables;
use App\PengawasanKeuangan;
use App\Imports\PengawasanImport;
use App\Desa;
use DB;
use Excel;

class PengawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PengawasanKeuangan::with('Desa')->where('tahun',2021);
            return Datatables::of($data)

                ->addColumn('desa', function ($data) {
                    return optional($data->Desa)->Nama_Desa;
                })
                ->addColumn('kecamatan', function ($data) {
                    return optional($data->Desa)->kecamatan->Nama_Kecamatan;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('pengawasan.edit', $data->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                    $btn .= '<a href="#"   data-url="' . route('pengawasan.hapus', $data->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'desa', 'kecamatan'])
                ->make(true);
        }
        return view('pengawasan.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'action' => route('pengawasan.store'),
            'method' => 'POST',
            'desa' => Desa::get()
        ];
        return view('pengawasan.form', \compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengawasanRequest $request)
    {
        // dd($request);
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            $fd = PengawasanKeuangan::where('kd_desa', $request->kd_desa)->where('tahun', 2021);
            if ($fd->count() > 0) {
                //   update
                $fd->update($data);
            } else {
                //    insert
                PengawasanKeuangan::create($data);
            }

            // PengawasanKeuangan::create($data);
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

        return redirect('pengawasan')->with(['status' => $pesan, 'type' => $type]);
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
        $pengawasan = PengawasanKeuangan::find($id);
        $data = [
            'action' => route('pengawasan.update', $id),
            'method' => 'PATCH',
            'desa' => Desa::get(),
            'res' => $pengawasan
        ];
        return view('pengawasan.form', \compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengawasanRequest $request, $id)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $pengawasan = PengawasanKeuangan::find($id);
            $data = $request->except(['_token', '_method']);
            $pengawasan->update($data);
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

        return redirect('pengawasan')->with(['status' => $pesan, 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengawasan = PengawasanKeuangan::find($id);
        $pengawasan->delete();
        return redirect('pengawasan')->with(['status' => 'Berhasil hapus data', 'type' => 'success']);
    }

    public function uploadData(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        // menangkap file excel
        $file = $request->file('file');
        $res = Excel::import(new PengawasanImport, $file);
        dd($res);
    }
}
