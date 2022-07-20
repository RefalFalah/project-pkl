<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = [
            ['nis' => '12345', 'nama' => 'Refal Falah', 'alamat' => 'Bandung', 'tanggal_lahir' => '2004-10-10'],
            ['nis' => '123456', 'nama' => 'Udin', 'alamat' => 'Bandung', 'tanggal_lahir' => '2005-1-1']
        ];

        DB::table('siswas')->insert($siswa);
    }
}
