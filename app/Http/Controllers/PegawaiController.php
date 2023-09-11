<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PegawaiStoreRequest;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\User;
use App\Pegawai;
use DB;
use Carbon\Carbon;
// use Faker\Factory as Faker;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userCan('pegawai.list')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        

        if ($request->ajax()) {
            $pegawai = Pegawai::query();
            return Datatables::of($pegawai)
                ->addColumn('action', function ($pegawai) {
                    $btn = '<a href="' . route('pegawai.edit', $pegawai->id) . '" class="btn btn-xs btn-primary"><i class=" fas fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('pegawai.create')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        $title = 'Tambah Pegawai';
        $data = array(
            'role' => Role::get(),
            'method' => 'POST',
            'action' => route('pegawai.store'),
            'ar' => []
        );
        return view('pegawai.form', \compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiStoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->only(['nama', 'email', 'no_hp', 'divisi']);
            $data['created_at'] = Carbon::now();
            $data['created_by'] = Auth::user()->id;
            $pegawai = Pegawai::create($data);

            // user
            $user = User::create([
                'name'  => $pegawai->nama,
                'email' => $pegawai->email,
                'pegawai_id' => $pegawai->id,
                'password'  => bcrypt($request->new_password)
            ]);

            $user->syncRoles($request->role);

            DB::commit();
            // all good
            $pesan = "Tambah pegawai berhasil";
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $pesan = 'Message: ' . $e->getMessage();
        }
        // dd($pegawai);
        return redirect()->route('pegawai.index')->with(['status' => $pesan]);
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
        if (!userCan('pegawai.edit')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        $title = 'Edit Pegawai';
        $user = User::where('pegawai_id', $id)->first();
        $data = array(
            'role' => Role::get(),
            'method' => 'PATCH',
            'action' => route('pegawai.update', $id),
            'pegawai' => Pegawai::find($id),
            'ar' => $user->getRoleNames()->toarray()
        );
        return view('pegawai.form', \compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiStoreRequest $request, $id)
    {
        //
        if (!userCan('pegawai.edit')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }

        DB::beginTransaction();
        try {
            $pegawai = Pegawai::find($id);

            $data = $request->only(['nama', 'email', 'no_hp', 'divisi']);
            $data['created_at'] = Carbon::now();
            $data['created_by'] = Auth::user()->id;
            $pegawai->update($data);


            // user
            $user = User::where('pegawai_id', $pegawai->id)->first();
            $user->update([
                'name'  => $pegawai->nama,
                'email' => $pegawai->email
            ]);

            $user->syncRoles($request->role);

            DB::commit();
            // all good
            $pesan = "Update pegawai berhasil";
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $pesan = 'Message: ' . $e->getMessage();
        }
        // dd($pegawai);
        return redirect()->route('pegawai.index')->with(['status' => $pesan]);
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
    }

    public function Pengantar()
    {
        $peg = DB::select(DB::raw("SELECT pegawai.id,pegawai.nama
        FROM pegawai 
        JOIN users ON users.pegawai_id=pegawai.id
        JOIN model_has_roles ON model_has_roles.model_id=users.id
        WHERE role_id=3"));
        $peg = array_map(function ($value) {
            return (array)$value;
        }, $peg);

        $array = [['id' => '', 'nama' => '']];
        echo json_encode(array_merge($array, $peg));
    }
}
