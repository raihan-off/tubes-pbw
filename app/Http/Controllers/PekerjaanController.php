<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{
    public function tampilPekerjaan(Request $request)
    {
        if ($request->ajax()) {

            //$data = Informasi::all();
            $data = Pekerjaan::latest()->get();
            // $data = Pekerjaan::all([
            //     'namaPerusahaan',
            //     'posisiPekerjaan',
            //     'kategoriPekerjaan',
            //     'lokasiPekerjaan',
            //     'deksripsiPekerjaan'
            // ]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPekerjaan">Edit</a>';

                    $btn = $btn . ' <a href="' . route("pekerjaan.delete", ["id" => $row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePekerjaan">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pekerjaan.index');
    }

    public function tambahPekerjaan(Request $request)
    {
        Pekerjaan::create(
            [
                'namaPerusahaan' => $request->namaPerusahaan,
                'posisiPekerjaan' => $request->posisiPekerjaan,
                'kategoriPekerjaan' => $request->kategoriPekerjaan,
                'lokasiPekerjaan' => $request->lokasiPekerjaan,
                'deskripsiPekerjaan' => $request->deskripsiPekerjaan,
                'status' => $request->status
            ]
        );

        return response()->json(['success' => 'Data pekerjaan berhasil ditambahkan']);
    }

    public function editPekerjaan($id)
    {
        $data = Pekerjaan::find($id);
        return response()->json($data);
    }

    public function ubahPekerjaan(Request $request, $id)
    {
        $info = Pekerjaan::find($id);
        $info->namaPerusahaan = $request->namaPerusahaan2;
        $info->posisiPekerjaan = $request->posisiPekerjaan2;
        $info->kategoriPekerjaan = $request->kategoriPekerjaan2;
        $info->lokasiPekerjaan = $request->lokasiPekerjaan2;
        $info->deskripsiPekerjaan = $request->deskripsiPekerjaan2;
        $info->status = $request->status2;

        $info->save();
        return response()->json([
            "success" => true,
        ]);
    }

    public function hapusPekerjaan($id)
    {
        Pekerjaan::find($id)->delete();
        return view('pekerjaan.index');
    }
}
