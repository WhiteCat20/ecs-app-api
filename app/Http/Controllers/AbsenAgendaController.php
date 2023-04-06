<?php

namespace App\Http\Controllers;

use App\Models\AbsenAgenda;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenAgendaController extends Controller
{
    public function store(Request $request)
    {
        $nama_agenda = $request->input('nama_agenda');
        $kode_absensi = $request->input('kode_absensi');

        $matchExists = Agenda::where('nama_agenda', $nama_agenda)->where('kode_absensi', $kode_absensi)->exists();

        if ($matchExists) {
            $validatedData = $request->validate([
                'nama_asisten' => 'required|string|max:255',
                'nama_agenda' => 'required',
                'kode_absensi' => 'required',
                'file_photo' => 'required|image|max:2048',
            ]);
            $file_photo = $request->file('file_photo');
            $nama_photo = $validatedData['nama_asisten'] . '-' . $validatedData['nama_agenda'] . '-' . $file_photo->getClientOriginalName();
            $tujuan_photo = 'storage/absen-agenda';
            $file_photo->move($tujuan_photo, $nama_photo);

            $absen = new AbsenAgenda([
                'nama_asisten' => $validatedData['nama_asisten'],
                'nama_agenda' => $validatedData['nama_agenda'],
                'kode_absensi' => $validatedData['kode_absensi'],
                'file_photo' => $nama_photo,
            ]);
            $absen->save();
            return response()->json([
                'data' => $absen,
                'message' => 'Absen Agenda uploaded successfully'
            ], 201);
        } else {
            return response()->json(['match' => false, 'message' => 'salah kode absensi tolol!!'], 404);
        }
    }
}
