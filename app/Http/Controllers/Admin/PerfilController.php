<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // public function __construct(){
    //     $this->middleware('can:ver perfil')->only('index');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        return view('admin.perfil.index');
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
        $user = User::find($id);
        $user->name = $request->nombre;
        $user->email = $request->correo;
        $user->telefono = $request->telefono;

        if ($request->hasFile('perfil')) {  
            $path = storage_path('app/public/uploads/users/'.$user->imagen);      
    
            if(File::exists($path)){
                File::delete($path); 
            }
    
            $file = $request->file('perfil');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->encode('jpg', 70);
            $image->save(storage_path('app/public/uploads/users/' . $filename));
            $user->imagen = $filename;
        }
        $user->update();

        return redirect('perfil')->with('status','Usuario actualizado exitosamente!.');
    }

    public function updateCredential(Request $request, $id){
        $user = User::find($id);
        $rules = [
            'passActual' => 'nullable|min:6',
            'pass' => 'nullable|min:6',
            'passConf' => 'nullable',
            // 'perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        if ($request->filled('passActual')) {
            // Validar la contraseña actual
            if (!Hash::check($request->input('passActual'), $user->password)) {
                return redirect()->back()->with('status', 'La contraseña actual es incorrecta.');
            }
            $rules['pass'] = 'required';
            
        }
        // Actualizar la contraseña si se proporcionó
        if ($request->filled('pass')) {
            $rules['passConf'] = 'required|same:pass';
            
            $user->password = bcrypt($request->input('pass'));
        }
    
        $request->validate($rules);

        $user->update();

        return redirect('/perfil')->with('status', 'Información actualizada exitosamente.');

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
