<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-puestos|crear-puestos|editar-puestos|borrar-puestos', ['only' => ['index']]);
        $this->middleware('permission:crear-puestos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-puestos', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-puestos', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view( 'roles.index', compact('roles') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view( 'roles.crear', compact('permission') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            'name' => 'required',
            'permission' => 'required',
        ] );

        $role = Role::create([
            'name' => $request->input('name')
        ]);
        dd($request->input('permission'));
        $role->syncPermissions( $request->input('permission') );

        return redirect()->route( 'roles.index' );
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
        $role= Role::find( $id );
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view( 'roles.editar', compact('role','permission', 'rolePermissions') );
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
        $this->validate( $request, [
            'name' => 'required',
            'permission' => 'required',
        ] );

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();

        return redirect()->route('roles.index');
    }
}
