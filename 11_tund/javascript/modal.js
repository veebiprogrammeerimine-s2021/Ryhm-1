let photoId;
let photoDir = "../upload_photos_normal/";

window.onload = function(){
    let allThumbs = document.querySelector("#gallery").querySelectorAll(".thumbs");
    for(let i = 0; i < allThumbs.length; i ++){
        allThumbs[i].addEventListener("click", openModal);
    }
    document.querySelector("#modalclose").addEventListener("click", closeModal);
}

function openModal(e){
    document.querySelector("#modalimg").src = photoDir + e.target.dataset.fn;
    document.querySelector("#modalcaption").innerHTML = e.target.alt;
    document.querySelector("#modalarea").style.display = "block";
}

function closeModal(){
    document.querySelector("#modalarea").style.display = "none";
    document.querySelector("#modalimg").src = "../pics/empty.png";
    document.querySelector("#modalcaption").innerHTML = "";
}