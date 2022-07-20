<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            ['nis' => '12345', 'kode_mp' => 'MP001', 'nilai' => 100],
        ];

        DB::table('nilais')->insert($nilai);
    }
}
