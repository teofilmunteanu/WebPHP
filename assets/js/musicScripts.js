window.onload = setVolume(0.5);

function toggleMusicOptions(){
    var element = document.getElementById("musicController");
    element.classList.toggle("show");
}

function setVolume(vol){
    var music = document.getElementById("music");
    music.volume = vol;
}