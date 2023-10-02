//Para hacerle seguimiento a los inputs

const formulario = document.querySelector(".form-login");
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

var nombre = false, apellido = false, cedula = false, nacimiento = false, telefono1 = false, telefono2 = true, correo = false;

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

const getDate = ()=>{
    var fecha = new Date();
    year = fecha.getFullYear();
    month = fecha.getMonth()+1;
    day = fecha.getDate();
    return date = [year, month, day];
}

const compareDate = (born)=>{
    date = getDate();
    born = born.split("-");
    if(!(born[0] < date[0])){
        if(!(born[1] < date[1])){
            if(!(born[2] <= date[2])){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }else{
        return true;
    }
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":
            if (expresiones.nombre.test(e.target.value)) {
                success(e.target.name);
                nombre = true;
            } else if (CharacterNoAllowN(e.target.value)) {
                nombre = false;
                error(e.target.name, 2);
            } else {
                nombre = false;
                error(e.target.name, 1);
            }
        break;
        case "apellido":
            if (expresiones.nombre.test(e.target.value)) {
                success(e.target.name);
                apellido = true;
            } else if (CharacterNoAllowN(e.target.value)) {
                apellido = false;
                error(e.target.name, 2);
            } else {
                apellido = false;
                error(e.target.name, 1);
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
        case "nacimiento":
            if(compareDate(e.target.value)){
                nacimiento = true;
            }else{
                nacimiento = false;
            }
        case "telefono1":
            if(expresiones.telefono.test(e.target.value)){
                success(e.target.name);
                telefono1 = true;
            }else if(CharacterNoAllowC(e.target.value)){
                error(e.target.name, 2);
                telefono1 = false;
            }else{
                error(e.target.name, 1);
                telefono1 = false;
            }
        break;
        case "telefono2":
            if(e.target.value.length == 0 || e.target.value.length == 7){
                success(e.target.name);
                telefono2 = true;
            }else if(CharacterNoAllowC(e.target.value)){
                error(e.target.name, 2);
                telefono2 = false;
            }else{
                error(e.target.name, 1);
                telefono2 = false;
            }
        break;
        case "correo":
            if(expresiones.correo.test(e.target.value)){
                success(e.target.name);
                correo = true;
            }else if(e.target.value.lenght <= 11 || e.target.value.lenght > 60){
                error(e.target.name, 2);
                correo = false;
            }else{
                error(e.target.name, 1);
                correo = false;
            }
        break;
    };
}

inputs.forEach(input => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e)=>{
    fechas = document.getElementById("blockedDate")
    if(fechas.textContent.length != 0){
        e.preventDefault();
    }else if(nombre && apellido && cedula && nacimiento && telefono1 && telefono2 && correo){
        e.preventDefault();
    }else{
        return true;
    }
});