let paginaActual = 1

filtrarInformacion(paginaActual)

document.getElementById("numeroRegistros").addEventListener("change", function(){
    filtrarInformacion(paginaActual);
}, false)

function filtrarInformacion(pagina){
    let numeroRegistros = document.getElementById("numeroRegistros").value;
    let tabla = document.getElementById("content");

    if (pagina != null){
        paginaActual = pagina
    }

    let contenido = new FormData()
    contenido.append("numeroRegistros", numeroRegistros)
    contenido.append("pagina", paginaActual)

    fetch("attendedCitationSearch.php", {
        method: "POST",
        body: contenido,
        mode: "cors"
    }).then(response => response.json())
    .then(data => {
        tabla.innerHTML = data.data
        document.getElementById("numeroPagina").innerHTML = data.totalRegistros + ' de ' + data.totalRegistros
        document.getElementById("navPaginacion").innerHTML = data.paginacion
    })
    .catch(error => console.log(error))
}