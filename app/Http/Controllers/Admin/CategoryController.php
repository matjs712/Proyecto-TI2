<?php
namespace App\Http\Controllers\Admin;

use App\Models\Logo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver categorias')->only('index');
        $this->middleware('can:add categorias')->only('create','store');
        $this->middleware('can:edit categorias')->only('edit', 'update');
        $this->middleware('can:destroy categorias')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logo_sitio();
        secciones();
        
        $categorias = Category::all();
        return view('admin.category.index', compact('categorias'));
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
            
        return view('admin.category.create');
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
            'name' => 'required|max:255',    
            'slug' => 'required|unique:categorias|max:255',    
            'description' => 'nullable|max:65535',    
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',    
            'status' => 'nullable',    
            'popular' => 'nullable'
        ], [    
            'name.required' => 'El nombre de la categoría es obligatorio.',    
            'name.max' => 'El nombre de la categoría no debe exceder los 255 caracteres.',    
            'slug.required' => 'El slug es obligatorio.',    
            'slug.unique' => 'El slug ya ha sido utilizado por otra categoría.',    
            'slug.max' => 'El slug no debe exceder los 255 caracteres.',    
            'description.max' => 'La descripción no debe exceder los 65535 caracteres.',    
            'image.required' => 'La imagen es obligatoria.',    
            'image.image' => 'El archivo seleccionado debe ser una imagen.',    
            'image.mimes' => 'La imagen debe tener un formato válido (jpg, jpeg, png o gif).',    
            'image.max' => 'La imagen no debe pesar más de 2MB.'
        ]);


    $categoria = new Category();

    if($request->hasFile('image')){
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;

        $image = Image::make($file);
        $image->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->encode('jpg', 70);
        $image->save(storage_path('app/public/uploads/categorias/' . $filename));
        $categoria->image = $filename;
    }

    $categoria->name = $request->input('name');
    $categoria->slug = $request->input('slug');
    $categoria->description = $request->input('description');
    $categoria->status = $request->input('status') == TRUE ? '1':'0';
    $categoria->popular = $request->input('status') == TRUE ? '1':'0';
    $categoria->save();

    return redirect('/categorias')->with('status', 'Categoría añadida exitosamente!.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Category::findOrFail($id);

        return view('admin.category.show', compact('categoria'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Category::find($id);
        logo_sitio();
        secciones();
        
        return view('admin.category.edit', compact('categoria'));
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
        $categoria = Category::find($id);

        $request->validate([
            'name' => ['required', Rule::unique('categorias')->ignore($categoria->id)],
            'slug' => ['required', Rule::unique('categorias')->ignore($categoria->id)],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['nullable', 'string'],
        ], [    
            'name.required' => 'El nombre de la categoría es obligatorio.',    
            'slug.required' => 'El slug es obligatorio.',    
            'slug.unique' => 'El slug ya ha sido utilizado por otra categoría.',    
            'description.max' => 'La descripción no debe exceder los 65535 caracteres.',    
            'image.required' => 'La imagen es obligatoria.',    
            'image.image' => 'El archivo seleccionado debe ser una imagen.',    
            'image.mimes' => 'La imagen debe tener un formato válido (jpg, jpeg, png o gif).',    
            'image.max' => 'La imagen no debe pesar más de 2MB.'
        ]);

        if($request->hasFile('image')){
            $path = storage_path('app/public/uploads/categorias/'.$categoria->imagen);          
            if(File::exists($path)){
                File::delete($path); 
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            
            $image = Image::make($file);
            $image->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->encode('jpg', 70);
            $image->save(storage_path('app/public/uploads/categorias/' . $filename));
            $categoria->image = $filename;
        }

        $categoria->name = $request->input('name');
        $categoria->slug = $request->input('slug');
        $categoria->description = $request->input('description');
        $categoria->status = $request->input('status') == TRUE ? '1':'0';
        $categoria->popular = $request->input('popular') == TRUE ? '1':'0';
        $categoria->update();

        return redirect('/categorias')->with('status','Categoría actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Category::find($id);

        if($categoria->image){
            $path = storage_path('app/public/uploads/categorias/'.$categoria->imagen);   
            
            if(File::exists($path)){
                File::delete($path); 
            }
        }

        $categoria->delete();
        return redirect('/categorias')->with('status','Categoría eliminada Exitosamente');
    }
}
