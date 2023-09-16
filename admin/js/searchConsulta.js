document.getElementById("search2").addEventListener("keyup", filtrarInformacion);

function filtrarInformacion() {
    let inputBuscar = document.getElementById("search2").value;
    let filtro = document.getElementById("filter2");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("search2", inputBuscar)

        fetch("parts/modalConsultationFilter.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtro.style.display = 'block'
                filtro.innerHTML = data
            })
            .catch(error => console.log(error))
    }
    else {
        filtro.style.display = 'none'
    }
}

// function mostrar(nombre) {
//     filtro.style.display = 'none'
//     alert("CP: " + nombre)
// }