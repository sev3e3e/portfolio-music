<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('creators')->insert([
            "name" => "ツユ",
        ]);
        DB::table('creators')->insert([
            "name" => "フロクロ",
        ]);
        DB::table('creators')->insert([
            "name" => "全てあなたの所為です。",
        ]);
        DB::table('creators')->insert([
            "name" => "buzzG",
        ]);
    }
}
