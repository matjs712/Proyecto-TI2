<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct(){
        $this->middleware('can:ver dashboard')->only('index');
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
        return view('admin.index');
    }
}
