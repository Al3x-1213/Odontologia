const button = document.querySelector(".insertar");
const modal = document.querySelector(".modal");

button.addEventListener("click", () => {
    modal.classList.remove("display")
})

document.querySelector(".xModal").addEventListener("click", () => {
    modal.classList.add("display")
})