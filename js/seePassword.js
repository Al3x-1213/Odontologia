let eyes = document.querySelector("#grupo_clave .icon-pencil");
let antiEyes = document.querySelector("#grupo_clave .icon-folder");

let eyes2 = document.querySelector("#grupo_clave2 .icon-pencil");
let antiEyes2 = document.querySelector("#grupo_clave2 .icon-folder");

eyes.addEventListener("click", ()=>{
    document.querySelector("#grupo_clave input").setAttribute("type","text");
    antiEyes.style.display = "block";
    eyes.style.display = "none";
})

eyes2.addEventListener("click", ()=>{
    document.querySelector("#grupo_clave2 input").setAttribute("type","text");
    antiEyes2.style.display = "block";
    eyes2.style.display = "none";
})

antiEyes.addEventListener("click", ()=>{
    document.querySelector("#grupo_clave input").setAttribute("type","password");
    antiEyes.style.display = "none";
    eyes.style.display = "block";
})

antiEyes2.addEventListener("click", ()=>{
    document.querySelector("#grupo_clave2 input").setAttribute("type","password");
    antiEyes2.style.display = "none";
    eyes2.style.display = "block";
})