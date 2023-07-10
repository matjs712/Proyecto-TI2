<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ver usuarios')->only('index');
        $this->middleware('can:ver configuracion')->only('configuracion');
        $this->middleware('can:add usuarios')->only('create', 'store');
        $this->middleware('can:edit usuarios')->only('edit', 'update');
        $this->middleware('can:ver info usuarios')->only('view');
        $this->middleware('can:destroy usuarios')->only('destroy');
    }

    public function index()
    {
        logo_sitio();
        secciones();

        $usuarios = User::all();
        $roles = Role::all();
        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        logo_sitio();
        secciones();

        $roles = Role::all();

        return view('admin.usuarios.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
        ];

        $messages = [

            'name.required' => 'El Nombre es obligatorio.',
            'role.required' => 'Debe seleccionar un Rol.',
            'email.required' => 'El Correo es obligatorio.',
            'email.email' => 'El Correo debe ser una dirección de correo válida.',
            'email.unique' => 'El campo Correo ya está en uso.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            session()->flash('loading', true);
            try {
                $user = new User();
                $user->name = $request->name;
                $user->role_as = $request->role;
                $user->email = $request->email;
                $user->password = bcrypt('password');
                $user->save();
                $user->roles()->sync($request->role);

                DB::commit();

                return redirect('usuarios')->with('status', 'Usuario creado exitosamente!');
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                return back()->withErrors($validator)->withInput();
            }
        }
        return back()->withErrors($validator)->withInput()->with('error', 'Existe un error en el formulario');
    }
    public function edit(User $user)
    {
        logo_sitio();
        secciones();
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('user', 'roles'));
    }
    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->role_as = $request->role_id;
        $user->update();

        // $user->roles()->sync($request->roles);
        $user->roles()->sync([$request->role_id]);

        return redirect('usuarios')->with('status', 'Usuario modificado exitosamente!.');
    }

    public function view($id)
    {
        logo_sitio();
        secciones();

        $usuario = User::find($id);
        return view('admin.usuarios.view', compact('usuario'));
    }
    public function configuracion()
    {
        logo_sitio();
        secciones();
        return view('admin.configuracion.index');
    }

    public function updateConfiguracion(Request $request)
    {

        // dd($request);
        session()->flash('loading', true);
        $logo_sitio = Logo::first();

        if ($request->hasFile('logo')) {
            $path = storage_path('app/public/logo/' . $logo_sitio->logo);
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);

            $image->save(storage_path('app/public/logo/' . $filename));

            $logo_sitio->logo = $filename;
        }

        $logo_sitio->sitio = $request->nombreSitio;
        $logo_sitio->update();

        $banner = Configuration::first();

        if ($request->hasFile('banner')) {
            $path = storage_path('app/public/banner/' . $banner->banner);

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('banner');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/banner/' . $filename));
            $banner->banner = $filename;
        }
        $banner->update();

        $oferta = Configuration::first();

        if ($request->hasFile('imagen_oferta')) {
            $path = storage_path('app/public/popup/' . $oferta->imagen_oferta);

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('imagen_oferta');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/popup/' . $filename));
            $oferta->imagen_oferta = $filename;
        }
        $oferta->update();

        $sobre_nosotros = Configuration::first();

        if ($request->hasFile('imagen_sobre_nosotros')) {
            $path = storage_path('app/public/aboutUs/' . $sobre_nosotros->image_sobre_nosotros);

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('imagen_sobre_nosotros');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/aboutUs/' . $filename));
            $sobre_nosotros->imagen_sobre_nosotros = $filename;
        }
        $sobre_nosotros->update();

        $historia = Configuration::first();

        if ($request->hasFile('imagen_fondo_historia')) {
            $path = storage_path('app/public/aboutUs/' . $historia->image_fondo_historia);

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('imagen_fondo_historia');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/aboutUs/' . $filename));
            $historia->imagen_fondo_historia = $filename;
        }
        $historia->update();

        if ($request->hasFile('imagen_texto_historia')) {
            $path = storage_path('app/public/aboutUs/' . $historia->image_texto_historia);

            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('imagen_texto_historia');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/aboutUs/' . $filename));
            $historia->imagen_texto_historia = $filename;
        }
        $historia->update();


        // SECCIONES
        $secciones = Configuration::first();
        $this->seccionesUpdate($secciones, $request);

        // COLORES
        $colores = Configuration::first();
        $this->coloresUpdate($colores, $request);


        $notifications = new Notification();
        $notifications->detalle = 'Se actualizo la información de sitio';
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 2;
        $notifications->save();

        return redirect('/configuracion')->with('status', 'Información de sitio actualizada exitosamente.');
    }

    private function seccionesUpdate($secciones, $request)
    {
        $secciones->productos = $request->productos === 'productos' ? 1 : 0;
        $secciones->ingredientes = $request->ingredientes === 'ingredientes' ? 1 : 0;
        $secciones->categorias = $request->categorias === 'categorias' ? 1 : 0;
        $secciones->recetas = $request->recetas === 'recetas' ? 1 : 0;
        $secciones->nutricionales = $request->nutricionales === 'nutricionales' ? 1 : 0;
        $secciones->proveedores = $request->proveedores === 'proveedores' ? 1 : 0;
        $secciones->registros = $request->registros === 'registros' ? 1 : 0;
        $secciones->usuarios = $request->usuarios === 'usuarios' ? 1 : 0;
        $secciones->roles_permisos = $request->roles_permisos === 'roles_permisos' ? 1 : 0;
        $secciones->ordenes = $request->ordenes === 'ordenes' ? 1 : 0;
        $secciones->update();
    }
    private function coloresUpdate($colores, $request)
    {
        $colores->color_barra_lateral = $request->color_barra_lateral;
        $colores->color_fondo_admin = $request->color_fondo_admin;
        $colores->color_barra_horizontal = $request->color_barra_horizontal;
        $colores->color_a_tag_sidebar = $request->color_a_tag_sidebar;
        $colores->color_a_tag_hover = $request->color_a_tag_hover;
        $colores->color_principal = $request->color_principal;
        $colores->color_secundario = $request->color_secundario;
        $colores->color_barra_busqueda = $request->color_barra_busqueda;

        $colores->texto_banner_uno = $request->texto_banner_1;
        $colores->texto_banner_dos = $request->texto_banner_2;
        $colores->texto_banner_tres = $request->texto_banner_3;
        $colores->texto_banner_cuatro = $request->texto_banner_4;

        $colores->habilitar_oferta = $request->habilitar_oferta === 'habilitado' ? 1 : 0;
        $colores->titulo_oferta = $request->titulo_oferta;
        $colores->subtitulo_oferta = $request->subtitulo_oferta;
        $colores->texto_oferta = $request->texto_oferta;
        $colores->valor_oferta = $request->valor_oferta;
        $colores->fecha_oferta = $request->fecha_oferta;

        $colores->titulo_sobre_nosotros = $request->titulo_sobre_nosotros;
        $colores->texto_1_sobre_nosotros = $request->texto_1_sobre_nosotros;
        $colores->texto_2_sobre_nosotros = $request->texto_2_sobre_nosotros;
        $colores->titulo_texto_3_sobre_nosotros = $request->titulo_texto_3_sobre_nosotros;
        $colores->texto_3_sobre_nosotros = $request->texto_3_sobre_nosotros;
        $colores->titulo_texto_4_sobre_nosotros = $request->titulo_texto_4_sobre_nosotros;
        $colores->texto_4_sobre_nosotros = $request->texto_4_sobre_nosotros;
        $colores->titulo_historia = $request->titulo_historia;
        $colores->texto_1_historia = $request->texto_1_historia;
        $colores->texto_2_historia = $request->texto_2_historia;
        $colores->texto_3_historia = $request->texto_3_historia;

        $colores->boton_calificacion = $request->boton_calificacion;
        $colores->boton_principal_busqueda = $request->boton_principal_busqueda;
        $colores->boton_review = $request->boton_review;
        $colores->boton_lista = $request->boton_lista;
        $colores->boton_carrito = $request->boton_carrito;
        $colores->boton_nuevo = $request->boton_nuevo;
        $colores->boton_editar = $request->boton_editar;
        $colores->boton_eliminar = $request->boton_eliminar;
        $colores->boton_vermas = $request->boton_vermas;
        $colores->boton_actualizar = $request->boton_actualizar;

        $colores->update();
    }

    public function updateCredenciales(Request $request)
    {
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
            $path = storage_path('app/public/users/' . $admin->imagen);

            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('perfil');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 70);
            $image->save(storage_path('app/public/users/' . $filename));
            $admin->imagen = $filename;
        }

        $notifications = new Notification();
        $notifications->detalle = 'Se actualizaron las credenciales de la cuenta';
        $notifications->id_usuario = Auth::id();
        $notifications->tipo = 2;
        $notifications->save();

        // Guardar los cambios
        $admin->save();

        return redirect('/configuracion')->with('status', 'Información actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->image) {
            $path = storage_path('app/public/users/' . $user->imagen);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $user->delete();
        return redirect('/usuarios')->with('status', 'Usuarios eliminado exitosamente.');
    }


    public function setDefaultTheme()
    {
        $config = Configuration::find(1);

        $config->update([
            'color_principal' => '#ffffff',
            'color_secundario' => '#088178',
            'color_barra_lateral' => '#343838',
            'color_fondo_admin' => '#ffffff',
            'color_barra_horizontal' => '#ffffff',
            'color_a_tag_sidebar' => '#ffffff',
            'color_a_tag_hover' => '#008C9E',
            'color_barra_busqueda' => '#ffffff',
            'boton_principal_busqueda' => '#EF2B41',
            'boton_calificacion' => '#F9BF76',
            'boton_review' => '#8EB2C5',
            'boton_lista' => '#615375',
            'boton_carrito' => '#EF2B41',
            'boton_nuevo' => '#00B4CC',
            'boton_editar' => '#F2A73D',
            'boton_eliminar' => '#C22047',
            'boton_vermas' => '#758918',
            'boton_actualizar' => '#F2A73D',
        ]);


        return redirect('/configuracion')->with('status', 'Se ha configurado el tema Default en el sistema.');
    }
}
