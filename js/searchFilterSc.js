document.getElementById("usuario").addEventListener("keyup", filtrarInformacion);

var filtroUser;

function filtrarInformacion() {
    let inputBuscar = document.getElementById("usuario").value;
    filtroUser = document.querySelector(".filterUsuario");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("usuario", inputBuscar)

        fetch("../searchNameUser.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtroUser.innerHTML = data
                if (filtroUser.textContent.length != 0) {
                    document.querySelector(`#grupo_usuario .icon-checkmark1`).classList.add("display");
                    document.querySelector(`#grupo_usuario .input__form`).classList.remove("success");
            
                    document.querySelector(`#grupo_usuario .icon-warning`).classList.remove("display");
                    document.querySelector(`#grupo_usuario .input__form`).classList.remove("base");
                    document.querySelector(`#grupo_usuario .input__form`).classList.add("error");
                }else{
                    document.querySelector(`#grupo_usuario .icon-warning`).classList.add("display");
                    document.querySelector(`#grupo_usuario .input__form`).classList.add("base");
                    document.querySelector(`#grupo_usuario .input__form`).classList.remove("error");
                }
            })
    } else {
        filtro.style.display = 'none'
    }
}

formulario.addEventListener("submit", (e) => {
    if (filtroUser.textContent.length == 0) {
        return true;
    } else {
        e.preventDefault();
    }
})