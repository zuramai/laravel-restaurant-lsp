<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Ahmad Saugi",
                "username" => "admin",
                "password" => Hash::make('admin'),
                "level_id" => 1
            ],
            [
                'name' => "Wwaiter",
                "username" => "waiter",
                "password" => Hash::make('waiter'),
                "level_id" => 2
            ],
            [
                'name' => "Kasir",
                "username" => "kasir",
                "password" => Hash::make('kasir'),
                "level_id" => 3
            ],
            [
                'name' => "Owners",
                "username" => "owner",
                "password" => Hash::make('owner'),
                "level_id" => 4
            ],
            [
                'name' => "Pelanggan 1",
                "username" => "pelanggan",
                "password" => Hash::make('pelanggan'),
                "level_id" => 5
            ],
        ]);
    }
}
