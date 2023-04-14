<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver usuarios')->only('index');
        $this->middleware('can:ver configuracion')->only('configuracion');
        $this->middleware('can:add usuarios')->only('create','store');
        $this->middleware('can:edit usuarios')->only('edit', 'update');
    }
    
    public function index(){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('sitio', $logo->sitio);
        View::share('logo', $path);

        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create(){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('sitio', $logo->sitio);
        View::share('logo', $path);
        return view('admin.usuarios.create');
    }
    public function store(){

    }
    public function edit(User $user){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('sitio', $logo->sitio);
        View::share('logo', $path);
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('user', 'roles'));
    }
    public function update(Request $request, User $user){
        $user->roles()->sync($request->roles);
        return redirect('usuarios')->with('status','Rol asignado correctamente');
    }

    public function view($id){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);

        $usuario = User::find($id);
        return view('admin.usuarios.view', compact('usuario'));
    }
    public function configuracion(){
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);
        return view('admin.configuracion.index');
    }
    public function updateConfiguracion(Request $request){
        $logo_sitio = Logo::first();
        if($request->hasFile('logo')){  
            $path = 'logo/'.$logo_sitio->logo;

            if(File::exists($path)){
                File::delete($path); 
            }

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->encode('jpg', 70);
            Storage::putFileAs('logo/', $file, $filename);
            $logo_sitio->logo = $filename;
        }

        $logo_sitio->sitio = $request->nombreSitio;
        $logo_sitio->update();

        return redirect('/configuracion')->with('status', 'Información de sitio actualizada exitosamente.');
        
    }
    public function updateCredenciales(Request $request){
        // Obtener el usuario autenticado
        $admin = User::where('id', Auth::id())->first();
    
        // Validación de los campos del formulario
        $rules = [
            'passActual' => 'nullable|min:6',
            'pass' => 'nullable|min:6',
            'passConf' => 'nullable',
            // 'perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        if ($request->filled('passActual')) {
            // Validar la contraseña actual
            if (!Hash::check($request->input('passActual'), $admin->password)) {
                return redirect()->back()->with('status', 'La contraseña actual es incorrecta.');
            }
            $rules['pass'] = 'required';
            
        }
        // Actualizar la contraseña si se proporcionó
        if ($request->filled('pass')) {
            $rules['passConf'] = 'required|same:pass';
            
            $admin->password = bcrypt($request->input('pass'));
        }
    
        $request->validate($rules);
    
        // Actualizar la imagen del perfil si se proporcionó
        if ($request->hasFile('perfil')) {  
            $path = 'users/'.$admin->imagen;
    
            if(File::exists($path)){
                File::delete($path); 
            }
    
            $file = $request->file('perfil');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->encode('jpg', 70);
            
            Storage::putFileAs('users', $file, $filename);
            $admin->imagen = $filename;
        }
    
    
        // Guardar los cambios
        $admin->save();
    
        return redirect('/configuracion')->with('status', 'Información actualizada exitosamente.');
    }
}
