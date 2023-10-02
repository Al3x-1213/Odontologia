let buttonEditable = document.querySelector(".buttonEditable");
let buttonEditable2 = document.querySelector(".buttonEditable2");

let divEditable1 = document.getElementById("divEditable1");
let divEditable2 = document.getElementById("divEditable2");
let divEditable3 = document.getElementById("divEditable3");
let divEditable4 = document.getElementById("divEditable4");

divEditable1.addEventListener("dblclick", function () {
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable1").classList.remove("hide");
    divEditable1.classList.add("hide");
});

divEditable2.addEventListener("dblclick", function () {
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable2").classList.remove("hide");
    divEditable2.classList.add("hide");
});

divEditable3.addEventListener("dblclick", function () {
    buttonEditable.classList.remove("hide");
    document.getElementById("inputEditable3").classList.remove("hide");
    divEditable3.classList.add("hide");
});

divEditable4.addEventListener("dblclick", function () {
    buttonEditable2.classList.remove("hide");
    document.getElementById("inputEditable4").classList.remove("hide");
    divEditable4.classList.add("hide");
});


document.getElementById("editContactInformation").addEventListener("submit", (e)=>{
    if(document.querySelector("#divEditable1 input").value.length != 7 && document.querySelector("#divEditable1 select").value.length != 4){
        e.preventDefault();
    }else if(document.querySelector("#divEditable2 input").value.length == 7 && document.querySelector("#divEditable2 select").value.length != 4){
        e.preventDefault();
    }else if(document.querySelector("#divEditable2 input").value.length == 0 && document.querySelector("#divEditable2 select").value.length == 4){
        e.preventDefault();
    }else{
        return true;
    }
})