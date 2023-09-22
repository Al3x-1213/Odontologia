document.getElementById("search").addEventListener("keyup", filtrarInformacion);

function filtrarInformacion() {
    let inputBuscar = document.getElementById("search").value;
    let filtro = document.querySelector(".filter");

    if (inputBuscar.length > 0) {
        let contenido = new FormData()
        contenido.append("search", inputBuscar)

        fetch("../searchNameUser.php", {
            method: "POST",
            body: contenido,
            mode: "cors"
        }).then(response => response.json())
            .then(data => {
                filtro.classList.remove('display');
                filtro.innerHTML = data
            })
            .catch(error => console.log(error))
    }
    else {
        filtro.classList.add = 'display';
    }
}