<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Logo::first();
        $path = 'logo/'.$logo->logo;
        View::share('logo', $path);
        View::share('sitio', $logo->sitio);
        return view('admin.index');
    }
}
