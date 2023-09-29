//Para hacerle seguimiento al formulario
const formulario = document.getElementById("formulario");
//Para hacerle seguimiento a los inputs
const inputs = document.querySelectorAll('.grupo input');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-\.\/]{4,35}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{3,25}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{8,35}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7}$/, // 7 a 14 numeros.
    cedula: /^\d{7,8}$/ // 7 a 14 numeros.
}

function CharacterSpecials(str) {
    var regex = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\?]+/;
    return regex.test(str);
}

function CharacterNoAllowN(str) {
    var regex = /[!@#$%^&*()+\=\[\]{};':"\\|,<>\?]+[0-9]/;
    return regex.test(str);
}

function CharacterNoAllowC(str) {
    var regex = /._-[!@#$%^&*()+\=\[\]{};':"\\|,<>\?]+[a-zA-ZÀ-ÿ]/;
    return regex.test(str);
}

function CharacterUpper(str) {
    var regex = /[A-Z]/;
    return regex.test(str);
}

var usuario = false, clave = false, clave2 = false, cedula = false;

var claves = [];

const success = (grupo) => {
    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error1`).style.display = "none";
    document.querySelector(`#grupo_${grupo} .paragraf__error2`).style.display = "none";

    document.querySelector(`#grupo_${grupo} .icon-checkmark1`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("base");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("success");
}

const error = (grupo, error) => {
    document.querySelector(`#grupo_${grupo} .icon-checkmark1`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("success");

    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("base");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error${error}`).style.display = "block";
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "usuario":
            if(expresiones.usuario.test(e.target.value)){
                success(e.target.name);
                usuario = true;
            }else if(CharacterSpecials(e.target.value)){
                error(e.target.name, 2);
                usuario = false;
            }else{
                error(e.target.name, 1);
                usuario = false;
            }
        break;
        case "clave":
            if(!expresiones.password.test(e.target.value)){
                error(e.target.name, 1);
                clave = false;
            }else if(!CharacterUpper(e.target.value)){
                document.querySelector(`#grupo_clave .paragraf__error1`).style.display = "none";
                error(e.target.name, 2);
                clave = false;
            }else if(!CharacterSpecials(e.target.value)){
                document.querySelector(`#grupo_clave .paragraf__error1`).style.display = "none";
                error(e.target.name, 2);
                clave = false;
            }else{
                success(e.target.name);
                claves[0] = e.target.value;
                clave = true;
            }
        break;
        case "clave2":
            if(expresiones.password.test(e.target.value)){
                claves[1] = e.target.value;
                if(claves[0] != claves[1]){
                    error(e.target.name, 1);
                    clave2 = false;
                }else{
                    success(e.target.name);
                    clave2 = true;
                }
            }else{
                error(e.target.name, 2);
                clave2 = false;
            }
        break;
        case "cedula":
            if(expresiones.cedula.test(e.target.value)){
                success(e.target.name);
                cedula = true;
            }else if(CharacterNoAllowC(e.target.value)){
                error(e.target.name, 2);
                cedula = false;
            }else{
                error(e.target.name, 1);
                cedula = false;
            }
        break;
    };
}

inputs.forEach(input => {
    input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e)=>{
    if(usuario && clave && clave2 && cedula){
        return true;
    }else{
        e.preventDefault();
    }
});