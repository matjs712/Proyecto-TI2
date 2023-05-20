<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        logo_sitio();
        secciones();

        $permissions = Permission::all();

       return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        $notifications = new Notification();
        $notifications->detalle = 'Rol añadido: ' . $role->name;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 0;
        $notifications->save();

        return redirect()->route('roles.edit',$role)->with('status','Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $rol)
    {
        logo_sitio();
        secciones();
        
        // dd($rol);
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $rol)
    {
        logo_sitio();
        secciones();
        $permissions = Permission::all();
       return view('admin.roles.edit', compact('rol','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $rol)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $rol->update($request->all());
        $rol->permissions()->sync($request->permissions);
        return redirect()->route('roles.edit',$rol)->with('status','Rol ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);


        $notifications = new Notification();
        $notifications->detalle = 'Rol eliminado: ' . $role->name;
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 2;
        $notifications->save();

        $role->delete();

        return redirect('/roles')->with('status','Rol eliminado Exitosamente');
    }
}
