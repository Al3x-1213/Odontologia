function filtrarInformacion(){
    let inputBuscar = document.getElementById("search").value;
    let tabla = document.getElementById("content");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("search", inputBuscar)

        fetch("registeredUserSearch.php", {
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