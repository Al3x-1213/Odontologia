document.getElementById("tipoPaciente").addEventListener("change", filtrarInformacion);

function filtrarInformacion() {
    let tipoPaciente = document.getElementById("tipoPaciente").value;
    let filtro = document.getElementById("causa");

    let contenido = new FormData()
    contenido.append("tipoPaciente", tipoPaciente)

    fetch("searchReasonFilter.php", {
        method: "POST",
        body: contenido,
        mode: "cors"
    }).then(response => response.json())
        .then(data => {
            filtro.innerHTML = data
        })
        .catch(error => console.log(error))
}