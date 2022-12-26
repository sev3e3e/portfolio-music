"use strict";

var audio = document.getElementById("audio");
var playButton = document.getElementById("playButton");
var pauseButton = document.getElementById("pauseButton");
var prevButton = document.getElementById("prevButton");
var nextButton = document.getElementById("nextButton");

var progressBar = document.getElementById("progress");
var volumeBar = document.getElementById("volume");
var playingStatus = document.getElementById("playingStatus");
var bg = document.getElementById("bg-video");
var audioSource = document.getElementById("audio-source");
var bgSource = document.getElementById("bg-source");
var songTitle = document.getElementById("playingMusicName");
var songCreator = document.getElementById("creator");

var mouseDownOnSlider = false;
var currentSongIndex = 0;
var isAudioPlaying = false;

const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

var datas = [];

function init() {
    progressBar.value = 0;
    volumeBar.value = audio.volume * 100;
}

window.addEventListener("DOMContentLoaded", () => {
    // init index page.
    // fetch(`/song/both?id=${currentSongId}`)
    //     .then((res) => res.json())
    //     .then((data) => {
    //         songData = data;
    //         changeButtonStyles(data);
    //         changeSong(data.song);
    //     });
    fetch(`/song/all`)
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            datas = data;
            changeButtonStyles(currentSongIndex);
            changeSong(data[0], false);
        });

    init();
});

function changeSong(data, isPlay) {
    console.log(data);
    bgSource.src = data.movie_source;
    bg.load();

    audioSource.src = data.audio_source;
    audio.load();

    songTitle.innerHTML = data.name;
    songCreator.innerHTML = data.creators[0].name;
    progressBar.value = 0;
    if (isPlay) {
        audio.play();
        bg.play();
    }
}

function changeButtonStyles(currentIndex) {
    length = datas.length - 1;

    if (0 >= currentIndex) {
        if (!prevButton.classList.contains("opacity-10")) {
            prevButton.classList.add("opacity-10");
        }

        if (!prevButton.classList.contains("cursor-default")) {
            prevButton.classList.add("cursor-default");
        }
    } else {
        prevButton.classList = [];
    }

    if (length <= currentIndex) {
        if (!nextButton.classList.contains("opacity-10")) {
            nextButton.classList.add("opacity-10");
        }

        if (!nextButton.classList.contains("cursor-default")) {
            nextButton.classList.add("cursor-default");
        }
    } else {
        nextButton.classList = [];
    }
}

playButton.addEventListener("click", () => {
    audio.play();
    bg.play();
});
pauseButton.addEventListener("click", () => {
    audio.pause();
    bg.pause();
});
prevButton.addEventListener("click", () => {
    if (0 >= currentSongIndex) return;

    audio.pause();
    bg.pause();

    pauseButton.hidden = true;
    playButton.hidden = false;

    currentSongIndex -= 1;
    changeButtonStyles(currentSongIndex);
    changeSong(datas[currentSongIndex], true);
});
nextButton.addEventListener("click", () => {
    if (datas.length - 1 <= currentSongIndex) return;

    audio.pause();
    bg.pause();

    pauseButton.hidden = true;
    playButton.hidden = false;

    currentSongIndex += 1;
    changeButtonStyles(currentSongIndex);
    changeSong(datas[currentSongIndex], true);
});

audio.addEventListener("play", () => {
    pauseButton.hidden = false;
    playButton.hidden = true;

    playingStatus.innerHTML = "playing...";

    isAudioPlaying = true;
});

audio.addEventListener("pause", () => {
    pauseButton.hidden = true;
    playButton.hidden = false;

    playingStatus.innerHTML = "pausing...";

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

    if (datas.length <= currentSongIndex) return;

    currentSongIndex += 1;
    changeButtonStyles(currentSongIndex);
    changeSong(datas[currentSongIndex], true);

    // fetch(`/song/both?id=${currentSongId + 1}`)
    //     .then((res) => res.json())
    //     .then((data) => {
    //         songData = data;
    //         changeButtonStyles(data);
    //         changeSong(data.song);

    //         currentSongId += 1;
    //     });
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

volumeBar.addEventListener("input", () => {
    audio.volume = volumeBar.value / 100;
});
