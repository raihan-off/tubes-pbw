<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function tampilPekerjaan(Request $request)
    {
        return view('pekerjaan.index');
    }
}
