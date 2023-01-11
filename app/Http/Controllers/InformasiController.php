<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Yajra\DataTables\Facades\DataTables;

class InformasiController extends Controller
{
    public function tampilInformasi(Request $request)
    {
        return view('informasi.index');
    }
}
