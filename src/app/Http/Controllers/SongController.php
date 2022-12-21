<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Creator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $song = Auth::user()
        //     ->songs()
        //     ->create([
        //         "name" => $request->songName,
        //         "description" => $request->songDesc,
        //     ]);
        $song = Auth::user()
            ->songs()
            ->create([
                "name" => $request->songName,
                "description" => $request->songDesc,
            ]);

        $creator = Creator::where("name", "=", $request->get("creator"))->first();

        if ($creator === null) {
            $_creator = $song->creators()->create([
                "name" => $request->get("creator")
            ]);
            $song->creators()->syncWithoutDetaching($_creator->id);
        } else {
            $song->creators()->syncWithoutDetaching($creator->id);
        }

        // info($obj);

        $disk = Storage::disk("gcs");

        $disk->put(
            "audios/{$song->id}.mp3",
            file_get_contents($request->file("songAudio"))
        );
        $disk->put(
            "medias/{$song->id}.mp4",
            file_get_contents($request->file("songMedia"))
        );

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $song = Song::find($id);
        return response()->json($song);
    }

    public function both(Request $request)
    {
        $id = $request->query("id");

        $disk = Storage::disk("gcs");

        $song = Song::find($id);
        $song->audioSrc = $disk->url("audios/${id}.mp3");
        $song->movieSrc = $disk->url("medias/${id}.mp4");
        $song->creator = $song->creators()->first();

        // return response()->json($song);
        $prev = Song::where("id", "<", $id)
            ->get()
            ->first();

        if ($prev != null) {
            $prevId = $prev->id;
            $prev->audioSrc = $prevId != null ? $disk->url("audios/${prevId}.mp3") : null;
            $prev->movieSrc = $prevId != null ? $disk->url("medias/${prevId}.mp4") : null;
            $prev->creator = $prev->creators()->first();
        }

        $next = Song::where("id", ">", $id)
            ->get()
            ->first();

        // $nextId = property_exists($next, "id") ? $next->id : null;

        // echo ($nextId);
        if ($next != null) {
            $nextId = $next->id;

            $next->audioSrc = $nextId != null ? $disk->url("audios/${nextId}.mp3") : null;
            $next->movieSrc = $nextId != null ? $disk->url("medias/${nextId}.mp4") : null;
            $next->creator = $next->creators()->first();
        }

        return response()->json([
            "song" => $song,
            "prev" => $prev,
            "next" => $next
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->get("id");
        $song = Song::find($id);

        $creator = Creator::where("name", "=", $request->get("songCreator"))->first();

        if ($creator === null) {
            $_creator = $song->creators()->create([
                "name" => $request->get("creator")
            ]);
            $song->creators()->syncWithoutDetaching($_creator->id);
        } else {
            $song->creators()->syncWithoutDetaching($creator->id);
        }

        $song->name = $request->get("songName");
        $song->description = $request->get("songDesc");
        if ($request->has("songAudio")) {
        }

        if ($request->has("songMedia")) {
        }

        $song->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }

    public function previous(Request $request)
    {
        $id = $request->query("id");
        return response()->json(Song::where("id", "<", $id)
            ->get()
            ->first());
    }

    public function next(Request $request)
    {
        $id = $request->query("id");
        return response()->json(Song::where("id", ">", $id)
            ->get()
            ->first());
    }

    public function all()
    {
        // $disk = Storage::disk("gcs");

        $datas = Song::with("creators")->get();

        // foreach ($datas as &$value) {
        //     $id = $value->id;
        //     $value->audioSrc = $disk->url("audios/${id}.mp3");
        //     $value->movieSrc = $disk->url("medias/${id}.mp4");
        // }
        return response()->json($datas);
    }
}
