"use strict";

var audio = document.getElementById("audio");
var playButton = document.getElementById("playButton");
var pauseButton = document.getElementById("pauseButton");
var progressBar = document.getElementById("progress");

var mouseDownOnSlider = false;

playButton.addEventListener("click", () => {
    audio.play();
});
pauseButton.addEventListener("click", () => {
    audio.pause();
});

audio.addEventListener("play", () => {
    pauseButton.hidden = false;
    playButton.hidden = true;
});

audio.addEventListener("pause", () => {
    pauseButton.hidden = true;
    playButton.hidden = false;
});

audio.addEventListener("timeupdate", () => {
    if (!mouseDownOnSlider) {
        progressBar.value = (audio.currentTime / audio.duration) * 100;
    }
});

progressBar.addEventListener("mousedown", () => {
    mouseDownOnSlider = true;
});
progressBar.addEventListener("mouseup", () => {
    mouseDownOnSlider = false;
});

progressBar.addEventListener("change", () => {
    const pct = progressBar.value / 100;
    audio.currentTime = (audio.duration || 0) * pct;
});
