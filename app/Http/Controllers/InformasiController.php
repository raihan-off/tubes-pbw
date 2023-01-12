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

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteInformasi">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data_tables;
    }

    public function tambahInformasi(Request $request)
    {
        Informasi::updateOrCreate(
            //['id' => $request->id],
            ['website' => $request->website],
            ['tautan' => $request->tautan],
            ['kategori' => $request->kategori],
            ['subKategori' => $request->subKategori],
            ['deskripsi' => $request->deskripsi],
        );

        return response()->json(['success' => 'Data website berhasil ditambahkan']);
    }

    public function editInformasi($id)
    {
        $data = Informasi::find($id);
        return response()->json($data);
    }

    public function hapusInformasi($id)
    {
        Informasi::find($id)->delete();
        return response()->json(['success' => 'Data website berhasil dihapus']);
    }
}
