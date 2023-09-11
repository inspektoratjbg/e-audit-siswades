<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userCan('permissions.list')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        if ($request->ajax()) {
            $permission = Permission::query();
            return Datatables::of($permission)
                ->order(function ($query) {
                        $query->orderBy('id', 'desc');
                })
                ->addColumn('action', function ($permission) {
                    $btn = '<a href="' . route('permission.edit', $permission->id) . '" class="btn btn-xs btn-primary"><i class="material-icons">edit</i></a>';
                    $btn .= '<a href="#"   data-url="' . route('permission.hapus', $permission->id) . '" class="hapus btn btn-xs btn-danger"><i class="material-icons">delete</i></a>';
                    return $btn;
                })
                ->make(true);
        }
        return view('Permission.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('permissions.create')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        $data = [
            'action' => route('permission.store'),
            'method' => 'POST',
            'role' => Role::all()
        ];

        return view('Permission.form', \compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!userCan('permissions.create')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        DB::beginTransaction();
        try {

            $vr = $request->role;
            $permission = Permission::create(['name' => $request->permission]);
            foreach ($vr as $vr) {
                $role = Role::where('name', $vr)->first();
                $role->givePermissionTo($permission);
                $permission->assignRole($role);
            }
            $pesan = "berhasil di tambahkan";
            $type = "success";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $pesan = $e->getMessage();
            $type = "warning";
        }

        return redirect()->route('permission.index')->with(['pesan' => $pesan, 'type' => $type]);
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
        if (!userCan('permissions.edit')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        $permission = Permission::find($id);
        $data = [
            'action' => route('permission.update', $id),
            'method' => 'PATCH',
            'role' => Role::get(),
            'permission' => $permission
        ];
        return view('Permission.form', \compact('data'));
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
        if (!userCan('permissions.edit')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        DB::beginTransaction();
        try {
            $permission = Permission::find($id);
            $permission->name = $request->permission;
            $permission->save();


            // revoke role
            $rr = Role::get();
            foreach ($rr as $rr) {
                $rr->revokePermissionTo($permission->name);
            }


            $vr = $request->role;
            foreach ($vr as $vr) {
                $role = Role::where('name', $vr)->first();
                $role->givePermissionTo($permission);
                $permission->assignRole($role);
            }
            $pesan = "berhasil di update";
            $type = "success";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $pesan = $e->getMessage();
            $type = "warning";
            // return false;
        }

        return redirect()->route('permission.index')->with(['pesan' => $pesan, 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!userCan('permissions.delete')) {
            \abort(403, 'Anda tidak memiliki hak ases');
        }
        $permission = Permission::find($id);
        $permission->delete();
        // dd($id);
        return redirect()->route('permission.index')->with(['pesan' => "data telah di hapus", 'type' => 'success']);
    }
}
