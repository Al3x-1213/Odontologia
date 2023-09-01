//Para hacerle seguimiento al formulario
const formulario = document.getElementById("formulario");
//Para hacerle seguimiento a los inputs
const inputs = document.querySelectorAll('.grupo input');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-\.\/]{3,35}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{2,25}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{4,35}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{11}$/, // 7 a 14 numeros.
    cedula: /^\d{7,8}$/ // 7 a 14 numeros.
}

var usuario = false, clave = false, clave2 = false, nombre = false, apellido = false, cedula = false, telefono1 = false, telefono2 = false, correo = false;

var claves = [];

const success = (grupo) => {
    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error`).classList.add("display");

    document.querySelector(`#grupo_${grupo} .icon-checkmark`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("base");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("success");
}

const error = (grupo) => {
    document.querySelector(`#grupo_${grupo} .icon-checkmark`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("success");

    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("base");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error`).classList.remove("display");
}

const obtenerFecha = ()=>{
    var fecha = new Date();
    year = fecha.getFullYear();
    mes = fecha.getMonth()+1;
    dia = fecha.getDate();
    return fecha = [year, mes, dia];
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "usuario":
            if(expresiones.usuario.test(e.target.value)){
                success(e.target.name);
                usuario = true;
            }else{
                error(e.target.name);
                usuario = false;
            }
        break;
        case "clave":
            if(expresiones.password.test(e.target.value)){
                success(e.target.name);
                clave = true;
                claves[0] = e.target.value;
            }else{
                error(e.target.name);
                clave = false;
            }
        break;
        case "clave2":
            if(expresiones.password.test(e.target.value)){
                claves[1] = e.target.value;
                if(claves[0] != claves[1]){
                    error(e.target.name);
                    clave2 = false;
                }else{
                    success(e.target.name);
                    clave2 = true;
                }
            }else{
                error(e.target.name);
                clave2 = false;
            }
        break;
        case "nombre":
            if(expresiones.nombre.test(e.target.value)){
                success(e.target.name);
                nombre = true;
            }else{
                error(e.target.name);
                nombre = false;
            }
        break;
        case "apellido":
            if(expresiones.nombre.test(e.target.value)){
                apellido = true;
                success(e.target.name);
            }else{
                error(e.target.name);
                apellido = false;
            }
        break;
        case "cedula":
            if(expresiones.cedula.test(e.target.value)){
                cedula = true;
                success(e.target.name);
            }else{
                error(e.target.name);
                cedula = false;
            }
        break;
        case "telefono1":
            if(expresiones.telefono.test(e.target.value)){
                telefono1 = true;
                success(e.target.name);
            }else{
                error(e.target.name);
                telefono1 = false;
            }
        break;
        case "telefono2":
            if(expresiones.telefono.test(e.target.value)){
                telefono2 = true;
                success(e.target.name);
            }else{
                error(e.target.name);
                telefono2 = false;
            }
        break;
        case "correo":
            if(expresiones.correo.test(e.target.value)){
                correo = true;
                success(e.target.name);
            }else{
                error(e.target.name);
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
    if(usuario && clave && clave2 && nombre && apellido && cedula && nacimiento && telefono1 && telefono2 && correo){
        return true;
    }else{
        e.preventDefault();
    }
});