<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InformasiController extends Controller
{
    public function tampilInformasi(Request $request)
    {
        if (!$request->ajax()) {
            return view('informasi.index');
        }

        //$data = Informasi::all();
        $data = Informasi::latest()->get();
        // $data = Informasi::all([
        //     'website',
        //     'tautan',
        //     'kategori',
        //     'subKategori',
        //     'deskripsi'
        // ]);

        $data_tables = Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editInformasi">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePekerjaan">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data_tables;
    }
}
