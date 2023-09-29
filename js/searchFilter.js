document.getElementById("usuario").addEventListener("keyup", filtrarInformacion);
document.getElementById("usuario").addEventListener("blur", filtrarInformacion);
document.getElementById("cedula").addEventListener("keyup", filtrarInformacion1);
document.getElementById("cedula").addEventListener("blur", filtrarInformacion1);

var filtroUser;
var filtroIc;

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

function filtrarInformacion1() {
    let inputBuscar = document.getElementById("cedula").value;
    filtroIc = document.querySelector(".filterCedula");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("cedula", inputBuscar)

        fetch("../searchNumberIc.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtroIc.innerHTML = data
                if (filtroIc.textContent.length != 0) {
                    document.querySelector(`#grupo_cedula .icon-checkmark1`).classList.add("display");
                    document.querySelector(`#grupo_cedula .input__form`).classList.remove("success");
            
                    document.querySelector(`#grupo_cedula .icon-warning`).classList.remove("display");
                    document.querySelector(`#grupo_cedula .input__form`).classList.remove("base");
                    document.querySelector(`#grupo_cedula .input__form`).classList.add("error");
                }else{
                    document.querySelector(`#grupo_cedula .icon-warning`).classList.add("display");
                    document.querySelector(`#grupo_cedula .input__form`).classList.add("base");
                    document.querySelector(`#grupo_cedula .input__form`).classList.remove("error");
                }
            })
    }
}


formulario.addEventListener("submit", (e) => {
    if (filtroUser.textContent.length == 0 && filtroIc.textContent.length == 0) {
        return true;
    } else {
        e.preventDefault();
    }
})