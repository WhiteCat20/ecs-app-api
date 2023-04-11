<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     DB::table('users')->insert([
    //         'name' => 'admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => Hash::make('admin'),
    //         'level' => 'admin',
    //     ]);
    //     DB::table('users')->insert([
    //         'name' => 'user',
    //         'email' => 'user@gmail.com',
    //         'password' => Hash::make('user'),
    //         'level' => 'user'
    //     ]);
    // }
    public function run(): void
    {
        // Specify the path to your Excel file
        $excelFile = database_path('seeders/data-asisten.xlsx');

        // Read the Excel file
        $spreadsheet = IOFactory::load($excelFile);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        // Get the header row
        $headers = array_shift($rows);

        // Loop through the rows and seed data
        foreach ($rows as $row) {
            $data = array_combine($headers, $row);

            // Encrypt the password
            $data['password'] = Hash::make($data['password']);

            // Insert the data into the users table
            DB::table('users')->insert($data);
        }
    }
}
