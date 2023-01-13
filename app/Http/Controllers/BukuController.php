<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BukuController extends Controller
{
    public function tampilBuku(Request $request)
    {
        if (!$request->ajax()) {
            return view('buku.index');
        }

        $data = Buku::all();
        //$data = Buku::latest()->get();

        $data_tables = Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" id="ngedit" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBuku">Edit</a>';

                $btn = $btn . ' <a href="' . route("buku.delete", ["id" => $row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBuku">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $data_tables;
    }

    public function tambahBuku(Request $request)
    {
        Buku::create(
            [
                'judul' => $request->judul,
                'penerbit' => $request->penerbit,
                'kategori' => $request->kategori,
                'jumlahHalaman' => $request->jumlahHalaman,
            ]
        );

        return response()->json(['success' => 'Data Buku berhasil ditambahkan']);
    }

    public function editBuku($id)
    {
        $data = Buku::find($id);
        return response()->json($data);
    }

    public function hapusBuku($id)
    {
        Buku::find($id)->delete();
        return view('buku.index');
    }
}
