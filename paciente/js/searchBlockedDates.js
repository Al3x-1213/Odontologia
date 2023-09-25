document.getElementById("atencion").addEventListener("change", filtrarInformacion);

function filtrarInformacion(){
    let inputBuscar = document.getElementById("atencion").value;
    let mensaje = document.getElementById("blockedDate");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("atencion", inputBuscar)

        fetch("searchBlockedDatesFilter.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                mensaje.innerHTML = data
            })
            .catch(error => console.log(error))
    }
}