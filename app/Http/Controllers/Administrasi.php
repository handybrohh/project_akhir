<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Administrasi extends Controller
{
    function tampil()  {
        return view('admin');
    }
}
