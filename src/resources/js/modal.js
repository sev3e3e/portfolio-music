import { enter, leave } from "el-transition";

var button = document.getElementById("modalopener");
var panel = document.getElementById("modal");
var modalAdd = document.getElementById("modalAdd");
var modalCancel = document.getElementById("modalCancel");

function openModal() {
    // panel.classList.remove("hidden");
    enter(panel);
}

function closeModal() {
    leave(panel);
}

button.addEventListener("click", () => {
    openModal();
});

// modalAdd.addEventListener("click", () => {
//     //closeModal();
// });

modalCancel.addEventListener("click", () => {
    closeModal();
});

var songAudio = document.getElementById("songAudio");
var songMedia = document.getElementById("songMedia");

songAudio.addEventListener("change", (e) => {
    var preview = document.getElementById("previewAudio");

    const file = songAudio.files[0];

    console.log(file);

    var reader = new FileReader();

    reader.addEventListener(
        "load",
        function () {
            // 画像ファイルを base64 文字列に変換します
            preview.src = reader.result;
        },
        false
    );

    if (file) {
        preview.controls = true;
        reader.readAsDataURL(file);
    }
});

songMedia.addEventListener("change", (e) => {
    var preview = document.getElementById("previewMedia");

    const file = songMedia.files[0];

    console.log(file);

    var reader = new FileReader();

    reader.addEventListener(
        "load",
        function () {
            // 画像ファイルを base64 文字列に変換します
            preview.src = reader.result;
        },
        false
    );

    if (file) {
        preview.controls = true;
        reader.readAsDataURL(file);
    }
});

var pmedia = document.getElementById("previewMedia");
pmedia.addEventListener("loadedmetadata", function () {
    if (pmedia.duration > 60) {
        // song-media-errors
        var ul = document.getElementById("song-media-errors");
        ul.innerHTML = "Video length is over 60 seconds.";
    }
    console.log(pmedia.duration);
});
