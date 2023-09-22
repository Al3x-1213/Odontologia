document.getElementById("usuario").addEventListener("keyup", filtrarInformacion);
document.getElementById("cedula").addEventListener("keyup", filtrarInformacion1);

function filtrarInformacion() {
    let inputBuscar = document.getElementById("usuario").value;
    let filtro = document.querySelector(".filterUsuario");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("usuario", inputBuscar)

        fetch("../searchNameUser.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtro.style.display = 'block'
                filtro.innerHTML = data
            })
            // .catch(error => console.log(error))
    }
    else {
        filtro.style.display = 'none'
    }
}

function filtrarInformacion1() {
    let inputBuscar = document.getElementById("cedula").value;
    let filtro = document.querySelector(".filterCedula");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("cedula", inputBuscar)

        fetch("../searchNumberIc.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtro.style.display = 'block'
                filtro.innerHTML = data
            })
            // .catch(error => console.log(error))
    }
    else {
        filtro.style.display = 'none'
    }
}