"use strict";

var audio = document.getElementById("audio");
var playButton = document.getElementById("playButton");
var pauseButton = document.getElementById("pauseButton");

var progressBar = document.getElementById("progress");
var playingStatus = document.getElementById("playingStatus");
var bg = document.getElementById("bg-video");
var audioSource = document.getElementById("audio-source");
var bgSource = document.getElementById("bg-source");
var songTitle = document.getElementById("playingMusicName");
var songCreator = document.getElementById("creator");

var mouseDownOnSlider = false;
var currentSongId = 1;
var isAudioPlaying = false;

const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

function changeSong(song) {
    console.log(song);
    bgSource.src = song.song.movieSrc;
    bg.load();

    audioSource.src = song.song.audioSrc;
    audio.load();

    songTitle.innerHTML = song.song.name;
    songCreator.innerHTML = song.song.creator.name;
    progressBar.value = -9999;
    // currentSongId += 1;
}

playButton.addEventListener("click", () => {
    audio.play();
    bg.play();
});
pauseButton.addEventListener("click", () => {
    audio.pause();
    bg.pause();
});

audio.addEventListener("play", () => {
    pauseButton.hidden = false;
    playButton.hidden = true;

    isAudioPlaying = true;
});

audio.addEventListener("pause", () => {
    pauseButton.hidden = true;
    playButton.hidden = false;

    isAudioPlaying = false;
});

audio.addEventListener("timeupdate", async () => {
    if (!mouseDownOnSlider && isAudioPlaying) {
        progressBar.value = (audio.currentTime / audio.duration) * 100;
    }

    bg.currentTime = audio.currentTime;
});

audio.addEventListener("ended", () => {
    isAudioPlaying = false;

    fetch(`/song/both?id=${currentSongId + 1}`)
        .then((res) => res.json())
        .then((data) => changeSong(data));
});

progressBar.addEventListener("mousedown", () => {
    mouseDownOnSlider = true;
});
progressBar.addEventListener("mouseup", () => {
    mouseDownOnSlider = false;
});

progressBar.addEventListener("change", () => {
    if (isAudioPlaying) {
        const pct = progressBar.value / 100;
        audio.currentTime = (audio.duration || 0) * pct;
        bg.currentTime = (audio.duration || 0) * pct;
    }
});
