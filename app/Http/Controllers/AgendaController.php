<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('created_at', 'desc')->get();
        return response()->json($agendas);
    }
    public function indexAll()
    {
        $agendas = Agenda::all();
        return response()->json($agendas);
    }
    public function getLastTwoAgenda()
    {
        $agendas = Agenda::orderBy('created_at', 'desc')->take(2)->get();
        return response()->json($agendas);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_agenda' => 'required',
            'tanggal' => 'required',
            'deskripsi' => 'required',
        ]);
        $min = 100000;
        $max = 999999;
        $randomNumber = str_pad(rand($min, $max), 6, '0', STR_PAD_LEFT);
        $agenda = new Agenda([
            'nama_agenda' => $validatedData['nama_agenda'],
            'tanggal' => $validatedData['tanggal'],
            'deskripsi' => $validatedData['deskripsi'],
            'kode_absensi' => $randomNumber
        ]);
        $agenda->save();

        return response()->json($agenda);
    }
    public function indexOne($id)
    {
        $agenda = Agenda::find($id);
        return response()->json($agenda);
    }
    public function update(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        $agenda->update($request->all());
        return response()->json($agenda);
    }

    public function delete($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        return response()->json(['message' => 'The Agenda has been deleted!']);
    }
}
