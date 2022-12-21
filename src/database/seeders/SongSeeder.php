<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("songs")->insert([
            "name" => "あの世行きのバスに乗ってさらば。",
            "description" => "",
            "audio_source" => "https://storage.googleapis.com/portfolio-music-storage/audios/1.mp3",
            "movie_source" => "https://storage.googleapis.com/portfolio-music-storage/medias/1.mp4",
            "user_id" => 1,
        ]);
        DB::table("songs")->insert([
            "name" => "黒塗り世界宛て書簡",
            "description" =>
            "この楽曲は放送衛生委員会に提出済であり、委員会の指導に基づき一部音声に修正を加えています。",
            "audio_source" => "https://storage.googleapis.com/portfolio-music-storage/audios/2.mp3",
            "movie_source" => "https://storage.googleapis.com/portfolio-music-storage/medias/2.mp4",
            "user_id" => 1,
        ]);
        DB::table("songs")->insert([
            "name" => "エヌ",
            "description" => "",
            "audio_source" => "https://storage.googleapis.com/portfolio-music-storage/audios/3.mp3",
            "movie_source" => "https://storage.googleapis.com/portfolio-music-storage/medias/3.mp4",
            "user_id" => 1,
        ]);
        DB::table("songs")->insert([
            "name" => "Fairytale,",
            "description" => "",
            "audio_source" => "https://storage.googleapis.com/portfolio-music-storage/audios/4.mp3",
            "movie_source" => "https://storage.googleapis.com/portfolio-music-storage/medias/4.mp4",
            "user_id" => 1,
        ]);
    }
}
