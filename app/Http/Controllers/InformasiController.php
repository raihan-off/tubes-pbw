<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function tampilInformasi(Request $request)
    {
        return view('informasi.index');
    }
}
