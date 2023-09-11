<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PerintahPengawasanRequest;
use App\PerintahPengawasan;
use Yajra\Datatables\Datatables;
use App\Desa;
use DB;
use Carbon\Carbon;

class PerintahPengawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PerintahPengawasan::with('Desa')->where('tahun',2021);
            return Datatables::of($data)
                ->order(function ($query) {
                        $query->orderBy('id', 'desc');
                })
                ->addColumn('desa', function ($data) {
                    return optional($data->Desa)->Nama_Desa;
                })
                ->addColumn('kecamatan', function ($data) {
                    return optional($data->Desa)->kecamatan->Nama_Kecamatan;
                })
                ->addColumn('action', function ($data) {
                    if ($data->tanggal_pengawasan == '') {
                        $btn = '<a data-desa="' . optional($data->Desa)->Nama_Desa . '" data-url="' . url('perintah/selesai', $data->id) . '" href="#" class="selesai btn btn-xs btn-info"><i class="material-icons">spellcheck</i></a>';
                        $btn .= '<a href="' . route('perintah.edit', $data->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                        $btn .= '<a href="#"   data-url="' . route('perintah.hapus', $data->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    } else {
                        return 'Telah dilakukan pengawasan pada tanggal <br><b>' . tanggal_indonesia($data->tanggal_pengawasan) . '</b>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'desa', 'kecamatan'])
                ->make(true);
        }
        return view('perintah.index');
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
            'action' => route('perintah.store'),
            'method' => 'POST',
            'desa' => Desa::get()
        ];
        return view('perintah.form', \compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerintahPengawasanRequest $request)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = $request->except(['_token', '_method']);
            PerintahPengawasan::create($data);
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

        return redirect('perintah')->with(['status' => $pesan, 'type' => $type]);
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
            'action' => route('perintah.update', $id),
            'method' => 'PATCH',
            'desa' => Desa::get(),
            'res' => PerintahPengawasan::find($id)
        ];
        return view('perintah.form', \compact('data'));
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
            $perintah = PerintahPengawasan::find($id);
            $data = $request->except(['_token', '_method']);
            $perintah->update($data);
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

        return redirect('perintah')->with(['status' => $pesan, 'type' => $type]);
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
        $perintah = PerintahPengawasan::find($id);
        $perintah->delete();
        return redirect('perintah')->with(['status' => 'Berhasil hapus data', 'type' => 'success']);
    }

    public function selesaiCtrl($id)
    {
        DB::beginTransaction();
        try {
            $perintah = PerintahPengawasan::find($id);
            $data = [
                'tanggal_pengawasan' => Carbon::now()
            ];
            $perintah->update($data);
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

        return redirect('perintah')->with(['status' => $pesan, 'type' => $type]);
    }
}
