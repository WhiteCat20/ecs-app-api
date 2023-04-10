<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $min = 100000;
        $max = 999999;
        $randomNumber = str_pad(rand($min, $max), 6, '0', STR_PAD_LEFT);

        DB::table('agendas')->insert([
            'nama_agenda' => 'Rapat Komunal',
            'tanggal' => '10 April 2023',
            'deskripsi' => 'rapat bahas keilmiahan di lab',
            'kode_absensi' => $randomNumber,
        ]);
        DB::table('agendas')->insert([
            'nama_agenda' => 'Bukber',
            'tanggal' => '13 April 2023',
            'deskripsi' => 'bukberr gesss lesgoo',
            'kode_absensi' => $randomNumber,
        ]);
    }
}
