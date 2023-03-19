<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cars = new Car();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/cars/', $filename);
            $cars->image = $filename;
        }

        $cars->name = $request->input('name');
        $cars->model = $request->input('model');
        $cars->brand = $request->input('brand');
        $cars->description = $request->input('description');
        $cars->save();

        return redirect('/auto')->with('status', 'Auto añadido exitosamente!');
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
        $cars = Car::find($id);
        return view('admin.car.edit', compact('cars'));
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
        $cars = Car::find($id);

        if($request->hasFile('image')){
            $path = 'assets/uploads/cars/'.$cars->image;
            
            if(File::exists($path)){
                File::delete($path); 
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/cars/', $filename);
            $auto->image = $filename;
        }

        $cars->name = $request->input('name');
        $cars->model = $request->input('model');
        $cars->brand = $request->input('brand');
        $cars->description = $request->input('description');
        
        $cars->update();

        return redirect('/auto')->with('status','Auto actualizado exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars = Car::find($id);

        if($cars->image){
            $path = 'assets/uploads/cars/'.$cars->image;
            
            if(File::exists($path)){
                File::delete($path); 
            }
        }

        $cars->delete();
        return redirect('/auto')->with('status','Auto eliminado exitosamente!');
    }
}
