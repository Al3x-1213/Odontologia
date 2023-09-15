const button = document.querySelector(".insertar");
const modal = document.querySelector(".modal");

button.addEventListener("click", () => {
    modal.classList.remove("disable");
})

document.querySelector(".icon-cross").addEventListener("click", () => {
    modal.classList.add("disable");
})