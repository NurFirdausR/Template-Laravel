<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WilayahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('m_provinsi')->truncate();
        DB::table('m_kabupaten')->truncate();
        DB::table('m_kecamatan')->truncate();
        DB::table('m_kelurahan')->truncate();

        $provinsi   = 'database/seeders/sql/provinsi.sql';
        $kabupaten  = 'database/seeders/sql/kabupaten.sql';
        $kecamatan  = 'database/seeders/sql/kecamatan.sql';
        $kelurahan  = 'database/seeders/sql/kelurahan.sql';

        DB::unprepared(file_get_contents($provinsi));
        DB::unprepared(file_get_contents($kabupaten));
        DB::unprepared(file_get_contents($kecamatan));
        DB::unprepared(file_get_contents($kelurahan));
    }
}
