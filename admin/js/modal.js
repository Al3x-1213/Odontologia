const buttons = document.querySelectorAll(".insertar");
const modal = document.querySelector(".modal");

buttons.forEach(button=>{
    button.addEventListener("click", ()=>{
        modal.classList.remove("disable");
    })
})

document.querySelector(".icon-cross").addEventListener("click", ()=>{
    modal.classList.add("disable");
})