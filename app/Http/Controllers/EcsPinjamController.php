<?php

namespace App\Http\Controllers;

use App\Models\EcsPinjam;
use Illuminate\Http\Request;

class EcsPinjamController extends Controller
{
    public function index()
    {
        $ecs_pinjam = EcsPinjam::orderBy('created_at', 'desc')->get();
        return response()->json($ecs_pinjam);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_barang" => 'required',
            "nama_peminjam" => 'required',
            "kepentingan" => 'required',
            "tanggal_pinjam" => 'required',
            "tanggal_kembali" => 'required',
            "foto_barang" => 'required|image',
            "jaminan" => 'required',
            "signature" => 'required',
        ]);
        $foto_barang = $request->file('foto_barang');
        $nama_foto_barang =  $validatedData['nama_barang'] . '-' . $validatedData['nama_peminjam'] . '-' . $foto_barang->getClientOriginalName();
        $tujuan_foto_barang = 'storage/ecs-pinjam';

        $foto_barang->move($tujuan_foto_barang, $nama_foto_barang);

        $ecs_pinjam = new EcsPinjam([
            "nama_barang" => $validatedData["nama_barang"],
            "nama_peminjam" => $validatedData["nama_peminjam"],
            "kepentingan" => $validatedData["kepentingan"],
            "tanggal_pinjam" => $validatedData["tanggal_pinjam"],
            "tanggal_kembali" => $validatedData["tanggal_kembali"],
            "foto_barang" => $nama_foto_barang,
            "jaminan" => $validatedData["jaminan"],
            "signature" => $validatedData["signature"],
        ]);

        $ecs_pinjam->save();

        return response()->json([
            'data' => $ecs_pinjam,
            'message' => 'Success!!'
        ]);
    }
}
