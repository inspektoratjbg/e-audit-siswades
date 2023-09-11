<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use app\User;
use DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!userCan('user.list')){
            \abort(403,'Anda tidak memiliki hak ases');
        }

        if ($request->ajax()) {
            $user = User::query();
            return Datatables::of($user)
                ->addColumn('roles', function ($user) {
                    $res = "";
                    foreach ($user->getRoleNames() as $rr) {
                        $res .= $rr . ", ";
                    }

                    return "<code>" . substr($res, 0, -2) . "</code>";
                })
                ->addColumn('action', function ($role) {
                    $btn = '<a href="' . route('account.edit', $role->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">lock</i></a>';
                    return $btn;
                })
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }

        return view('Account.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if(!userCan('user.role')){
            \abort(403,'Anda tidak memiliki hak ases');
        }
        $user = User::find($id);
        $data = [
            'action' => route('account.update', $id),
            'method' => 'PATCH',
            'user' => $user,
            'role' => Role::get(),
            'ar' => $user->getRoleNames()->toarray()
        ];

        return view('Account.form', \compact('data'));
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
        if(!userCan('user.role')){
            \abort(403,'Anda tidak memiliki hak ases');
        }
        //
        // dd($request->role);
        $user = User::find($id);
        $user->syncRoles($request->role);

        // dd($user);
        return redirect()->route('account.index')->with(['pesan' => 'Berhasil di proses', 'type' => 'success']);
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
}
