// document.getElementById("search").addEventListener("keyup", filtrarInformacion);

// function filtrarInformacion(){
//     let inputBuscar = document.getElementById("search").value;
//     let filtro = document.getElementById("filter");

//     let contenido = new FormData();
//     contenido.append("search", inputBuscar);

//     fetch("../searchPatientsFilter.php", {
//         method: "POST",
//         body: contenido
//     }).then(response => response.json())
//     .then(data => {
//         filtro.style.display = 'block'
//         filtro.innerHTML = data
//     })
//     .catch(error => console.log(error))
// }

document.getElementById("search").addEventListener("keyup", filtrarInformacion);

function filtrarInformacion() {

    let inputCP = document.getElementById("search").value
    let lista = document.getElementById("filter")

    if (inputCP.length > 0) {

        let url = "../searchPatientsFilter.php"
        let formData = new FormData()
        formData.append("search", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))
    } else {
        lista.style.display = 'none'
    }
}

// function mostrar(cp) {
//     lista.style.display = 'none'
//     alert("CP: " + cp)
// }