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
    photoId = e.target.dataset.id;
    console.log(photoDir + e.target.dataset.fn);
    document.querySelector("#avgRating").innerHTML = "";
    for(let i = 1; i < 6; i ++){
        document.querySelector("#rate" + i).checked = false;
    }
    document.querySelector("#modalcaption").innerHTML = e.target.alt;
    document.querySelector("#modalarea").style.display = "block";
    document.querySelector("#storeRating").addEventListener("click", storeRating);
}

function closeModal(){
    document.querySelector("#modalarea").style.display = "none";
    document.querySelector("#modalimg").src = "../pics/empty.png";
    document.querySelector("#modalcaption").innerHTML = "";
}

function storeRating(){
    let rating = 0;
    for(let i = 1; i < 6; i ++){
        if(document.querySelector("#rate" + i).checked){
            rating = i;
        }
    }
    if(rating > 0){
        //AJAX
        let webRequest = new XMLHttpRequest();
        webRequest.onreadystatechange = function(){
            //kas õnnestus
            if(this.readyState == 4 && this.status == 200){
                //asjad, mida teha, kui õnnestus
                //vastuseks tuleb this.responseText;
                document.querySelector("#avgRating").innerHTML = "Keskmine hinne: " + this.responseText;
				document.querySelector("#rating" + photoId).innerHTML = this.responseText;
                document.querySelector("#storeRating").removeEventListener("click", storeRating);
            }
        };
        webRequest.open("GET", "store_photorating.php?photo=" + photoId + "&rating=" + rating, true);
        webRequest.send();
        //AJAX lõppes
    }
}