<?php

namespace Database\Seeders;

use App\Models\Creator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatorSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Creator::find(1)->songs()->syncWithoutDetaching(1);
        Creator::find(2)->songs()->syncWithoutDetaching(2);
        Creator::find(3)->songs()->syncWithoutDetaching(3);
        Creator::find(4)->songs()->syncWithoutDetaching(4);
    }
}
