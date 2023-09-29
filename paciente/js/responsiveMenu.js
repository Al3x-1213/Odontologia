const buttonMenu = document.querySelector(".button__menu-responsive");

buttonMenu.addEventListener("click", ()=>{
    document.querySelector(".background__menu-responsive ").classList.remove("display");
    document.querySelector(".container__menu-responsive ").classList.remove("displaced");
});

const exit = document.querySelector(".x");

exit.addEventListener("click", ()=>{
    document.querySelector(".background__menu-responsive ").classList.add("display");
    document.querySelector(".container__menu-responsive ").classList.add("displaced");
});