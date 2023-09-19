filtrarInformacion()

document.getElementById("searchUser").addEventListener("keyup", filtrarInformacion);

function filtrarInformacion(){
    let inputBuscar = document.getElementById("searchUser").value;
    let tabla = document.getElementById("content");

    let contenido = new FormData()
    contenido.append("searchUser", inputBuscar)

    fetch("registeredUserSearch.php", {
        method: "POST",
        body: contenido,
        mode: "cors"
    }).then(response => response.json())
    .then(data => {
        tabla.innerHTML = data
    })
    .catch(error => console.log(error))
}