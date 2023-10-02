document.getElementById("cedula").addEventListener("keyup", filtrarInformacion1);
document.getElementById("cedula").addEventListener("blur", filtrarInformacion1);

var filtroIc;

function filtrarInformacion1() {
    let inputBuscar = document.getElementById("cedula").value;
    filtroIc = document.querySelector(".filterCedula");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("cedula", inputBuscar)

        fetch("../../searchNumberIc.php", {
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
    if (filtroIc.textContent.length == 0) {
        return true;
    } else {
        e.preventDefault();
    }
})