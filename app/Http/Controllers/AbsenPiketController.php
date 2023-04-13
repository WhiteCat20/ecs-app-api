<?php

namespace App\Http\Controllers;

use App\Models\AbsenPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsenPiketController extends Controller
{
    public function index()
    {
        $absen_piket = AbsenPiket::orderBy('created_at', 'desc')->get();
        return response()->json($absen_piket);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_asisten' => 'required|string|max:255',
            'hari' => 'required',
            'berita_acara' => 'required|string',
            'file_photo' => 'required|image',
        ]);
        $file_photo = $request->file('file_photo');
        $nama_photo = $validatedData['nama_asisten'] . '-' . $validatedData['hari'] . '-' . $file_photo->getClientOriginalName();
        $tujuan_photo = 'storage/absen';

        $file_photo->move($tujuan_photo, $nama_photo);

        $absen = new AbsenPiket([
            'nama_asisten' => $validatedData['nama_asisten'],
            'hari' => $validatedData['hari'],
            'berita_acara' => $validatedData['berita_acara'],
            'file_photo' => $nama_photo,
        ]);
        $absen->save();

        return response()->json([
            'data' => $absen,
            'message' => 'Absen Piket uploaded successfully'
        ]);
    }

    public function delete($id)
    {
        $absen_piket = AbsenPiket::findOrFail($id);
        $absen_piket->delete();
        return response()->json(['message' => 'The Piket has been deleted!']);
    }

    public function randomNumber()
    {
        $min = 100000;
        $max = 999999;
        $randomNumber = str_pad(rand($min, $max), 6, '0', STR_PAD_LEFT);
        return response()->json($randomNumber);
    }
}
