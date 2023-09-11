<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengaduanRequest;
use Illuminate\Http\Request;
use App\Imports\PengaduanImport;
use Yajra\Datatables\Datatables;
use App\Pengaduan;
use App\Desa;

use DB;
use Excel;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengaduan::with('Desa')->where('tahun',2021);
            return Datatables::of($data)

                ->addColumn('desa', function ($data) {
                    return optional($data->Desa)->Nama_Desa;
                })
                ->addColumn('kecamatan', function ($data) {
                    return optional($data->Desa)->kecamatan->Nama_Kecamatan;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('pengaduan.edit', $data->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                    $btn .= '<a href="#"   data-url="' . route('pengaduan.hapus', $data->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'desa', 'kecamatan'])
                ->make(true);
        }
        return view('pengaduan.index');
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
            'action' => route('pengaduan.store'),
            'method' => 'POST',
            'desa' => Desa::get()
        ];
        return view('pengaduan.form', \compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengaduanRequest $request)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            $fd = Pengaduan::where('kd_desa', $request->kd_desa)->where('tahun', 2021);
            if ($fd->count() > 0) {
                //   update
                $fd->update($data);
            } else {
                //    insert
                Pengaduan::create($data);
            }
            // Pengaduan::create($data);
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

        return redirect('pengaduan')->with(['status' => $pesan, 'type' => $type]);
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
        $data = [
            'action' => route('pengaduan.update', $id),
            'method' => 'PATCH',
            'desa' => Desa::get(),
            'res' => Pengaduan::find($id)
        ];
        return view('pengaduan.form', \compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $pengaduan = Pengaduan::find($id);
            $data = $request->except(['_token', '_method']);
            $pengaduan->update($data);
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

        return redirect('pengaduan')->with(['status' => $pesan, 'type' => $type]);
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
        $pengaduan = Pengaduan::find($id);
        $pengaduan->delete();
        return redirect('pengaduan')->with(['status' => 'Berhasil hapus data', 'type' => 'success']);
    }
    public function uploadData(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');
        $res = Excel::import(new PengaduanImport, $file);
        dd($res);
    }
}
