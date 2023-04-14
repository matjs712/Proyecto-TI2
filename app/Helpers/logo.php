<?php

use App\Models\Logo;
use Illuminate\Support\Facades\View;

function logo_sitio(){
    $logo = Logo::first();
    $path = 'logo/'.$logo->logo;
    View::share('logo', $path);
    View::share('sitio', $logo->sitio);
}