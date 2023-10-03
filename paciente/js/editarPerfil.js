// CONTRASEÑA

let button5 = document.getElementById("button5");

button5.addEventListener("click", function(){
    window.open("editarPerfil/editarClave.php", "_self");
});

// OTROS DATOS

let buttonEditable = document.querySelector(".buttonEditable");
let buttonEditable2 = document.querySelector(".buttonEditable2");

let button1 = document.getElementById("button1");
let divEditable1 = document.getElementById("divEditable1");

let button2 = document.getElementById("button2");
let divEditable2 = document.getElementById("divEditable2");

let button3 = document.getElementById("button3");
let divEditable3 = document.getElementById("divEditable3");

let divEditable4 = document.getElementById("divEditable4");

button1.addEventListener("click", function(){
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable1").classList.remove("hide");
    divEditable1.classList.add("hide");
});

button2.addEventListener("click", function(){
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable2").classList.remove("hide");
    divEditable2.classList.add("hide");
});

button3.addEventListener("click", function(){
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable3").classList.remove("hide");
    divEditable3.classList.add("hide");
});

button4.addEventListener("click", function(){
    buttonEditable2.classList.remove("hide");
    document.getElementById("inputEditable4").classList.remove("hide");
    divEditable4.classList.add("hide");
});