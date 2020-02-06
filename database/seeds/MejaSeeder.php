<?php

use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mejas')->insert([
            [
                'no_meja' => 1,
                'name' => 'Meja Bundar',
                'lokasi' => 'Dekat Pintu'
            ],[
                'no_meja' => 2,
                'name' => 'Meja Panjang',
                'lokasi' => 'Dekat Pintu'
            ]
        ]);
    }
}
