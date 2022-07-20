<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            ['kode_mp' => 'MP001', 'nama_mp' => 'Bahasa Indonesia', 'semester' => 1, 'jurusan' => 'Rekayasa Perangat Lunak'],
        ];

        DB::table('jurusans')->insert($jurusan);
    }
}
