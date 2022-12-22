<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Models\Creator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $song = Song::first();
    // $id = $song->id;

    // $disk = Storage::disk("gcs");

    // return view('index', [
    //     "song" => $song,
    //     "songSrc" => $disk->url("audios/${id}.mp3"),
    //     "movieSrc" => $disk->url("medias/${id}.mp4"),
    // ]);
    return view("index");
})->name("home");

Route::get("song/prev", [SongController::class, "previous"]);
Route::get("song/next", [SongController::class, "next"]);
Route::get("song/both", [SongController::class, "both"]);
Route::get("song/all", [SongController::class, "all"]);

Route::get("song/create", [SongController::class, "create"])->middleware(['auth', 'verified'])->name("song.create");
Route::post("song/create", [SongController::class, "store"])->middleware(["auth", "verified"])->name("song.store");

Route::get("song/{id}", [SongController::class, "show"]);
Route::patch("song/{id}", [SongController::class, "update"]);
Route::delete("song/{id}", [SongController::class, "delete"]);


Route::resource('songs', SongController::class);

Route::get('/dashboard', function () {
    $songs = Auth::user()->songs()->with("creators")->get();
    return view('dashboard', [
        "songs" => $songs
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
