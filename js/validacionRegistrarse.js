//Para hacerle seguimiento al formulario
const formulario = document.getElementById("formulario");
//Para hacerle seguimiento a los inputs
const inputs = document.querySelectorAll('.grupo input');

const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{3,35}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,25}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,35}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{11}$/, // 7 a 14 numeros.
    cedula: /^\d{8}$/ // 7 a 14 numeros.
}

const validarFormulario = (e)=>{
    switch (e.target.name){
        case "usuario":
            if(expresiones.usuario.test(e.target.value)){

                document.querySelector("#grupo_usuario .icon-warning").classList.add("display");
                document.querySelector("#grupo_usuario .input__form").classList.remove("error");

                document.querySelector("#grupo_usuario .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_usuario .input__form").classList.remove("base");
                document.querySelector("#grupo_usuario .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_usuario .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_usuario .input__form").classList.remove("success");

                document.querySelector("#grupo_usuario .icon-warning").classList.remove("display");
                document.querySelector("#grupo_usuario .input__form").classList.remove("base");
                document.querySelector("#grupo_usuario .input__form").classList.add("error");
            }
        break;
        case "clave":
            if(expresiones.password.test(e.target.value)){

                document.querySelector("#grupo_clave .icon-warning").classList.add("display");
                document.querySelector("#grupo_clave .input__form").classList.remove("error");

                document.querySelector("#grupo_clave .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_clave .input__form").classList.remove("base");
                document.querySelector("#grupo_clave .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_clave .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_clave .input__form").classList.remove("success");

                document.querySelector("#grupo_clave .icon-warning").classList.remove("display");
                document.querySelector("#grupo_clave .input__form").classList.remove("base");
                document.querySelector("#grupo_clave .input__form").classList.add("error");
            }
        break;
        case "clave2":
            if(expresiones.password.test(e.target.value)){

                document.querySelector("#grupo_clave2 .icon-warning").classList.add("display");
                document.querySelector("#grupo_clave2 .input__form").classList.remove("error");

                document.querySelector("#grupo_clave2 .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_clave2 .input__form").classList.remove("base");
                document.querySelector("#grupo_clave2 .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_clave2 .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_clave2 .input__form").classList.remove("success");

                document.querySelector("#grupo_clave2 .icon-warning").classList.remove("display");
                document.querySelector("#grupo_clave2 .input__form").classList.remove("base");
                document.querySelector("#grupo_clave2 .input__form").classList.add("error");
            }
        break;
        case "nombre":
            case "usuario":
            if(expresiones.nombre.test(e.target.value)){

                document.querySelector("#grupo_nombre .icon-warning").classList.add("display");
                document.querySelector("#grupo_nombre .input__form").classList.remove("error");

                document.querySelector("#grupo_nombre .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_nombre .input__form").classList.remove("base");
                document.querySelector("#grupo_nombre .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_nombre .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_nombre .input__form").classList.remove("success");

                document.querySelector("#grupo_nombre .icon-warning").classList.remove("display");
                document.querySelector("#grupo_nombre .input__form").classList.remove("base");
                document.querySelector("#grupo_nombre .input__form").classList.add("error");
            }
        break;
        case "apellido":
            if(expresiones.nombre.test(e.target.value)){

                document.querySelector("#grupo_apellido .icon-warning").classList.add("display");
                document.querySelector("#grupo_apellido .input__form").classList.remove("error");

                document.querySelector("#grupo_apellido .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_apellido .input__form").classList.remove("base");
                document.querySelector("#grupo_apellido .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_apellido .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_apellido .input__form").classList.remove("success");

                document.querySelector("#grupo_apellido .icon-warning").classList.remove("display");
                document.querySelector("#grupo_apellido .input__form").classList.remove("base");
                document.querySelector("#grupo_apellido .input__form").classList.add("error");
            }
        break;
        case "cedula":
            if(expresiones.cedula.test(e.target.value)){

                document.querySelector("#grupo_cedula .icon-warning").classList.add("display");
                document.querySelector("#grupo_cedula .input__form").classList.remove("error");

                document.querySelector("#grupo_cedula .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_cedula .input__form").classList.remove("base");
                document.querySelector("#grupo_cedula .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_cedula .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_cedula .input__form").classList.remove("success");

                document.querySelector("#grupo_cedula .icon-warning").classList.remove("display");
                document.querySelector("#grupo_cedula .input__form").classList.remove("base");
                document.querySelector("#grupo_cedula .input__form").classList.add("error");
            }
        break;
        case "telefono1":
            if(expresiones.telefono.test(e.target.value)){

                document.querySelector("#grupo_telefono1 .icon-warning").classList.add("display");
                document.querySelector("#grupo_telefono1 .input__form").classList.remove("error");

                document.querySelector("#grupo_telefono1 .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_telefono1 .input__form").classList.remove("base");
                document.querySelector("#grupo_telefono1 .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_telefono1 .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_telefono1 .input__form").classList.remove("success");

                document.querySelector("#grupo_telefono1 .icon-warning").classList.remove("display");
                document.querySelector("#grupo_telefono1 .input__form").classList.remove("base");
                document.querySelector("#grupo_telefono1 .input__form").classList.add("error");
            }
        break;
        case "telefono2":
            if(expresiones.telefono.test(e.target.value)){

                document.querySelector("#grupo_telefono2 .icon-warning").classList.add("display");
                document.querySelector("#grupo_telefono2 .input__form").classList.remove("error");

                document.querySelector("#grupo_telefono2 .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_telefono2 .input__form").classList.remove("base");
                document.querySelector("#grupo_telefono2 .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_telefono2 .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_telefono2 .input__form").classList.remove("success");

                document.querySelector("#grupo_telefono2 .icon-warning").classList.remove("display");
                document.querySelector("#grupo_telefono2 .input__form").classList.remove("base");
                document.querySelector("#grupo_telefono2 .input__form").classList.add("error");
            }
        break;
        case "correo":
            if(expresiones.correo.test(e.target.value)){

                document.querySelector("#grupo_correo .icon-warning").classList.add("display");
                document.querySelector("#grupo_correo .input__form").classList.remove("error");

                document.querySelector("#grupo_correo .icon-checkmark").classList.remove("display");
                document.querySelector("#grupo_correo .input__form").classList.remove("base");
                document.querySelector("#grupo_correo .input__form").classList.add("success");
            }else{

                document.querySelector("#grupo_correo .icon-checkmark").classList.add("display");
                document.querySelector("#grupo_correo .input__form").classList.remove("success");

                document.querySelector("#grupo_correo .icon-warning").classList.remove("display");
                document.querySelector("#grupo_correo .input__form").classList.remove("base");
                document.querySelector("#grupo_correo .input__form").classList.add("error");
            }
        break;
    };
}

inputs.forEach(input=>{
    input.addEventListener("keyup", validarFormulario)
    input.addEventListener("blur", validarFormulario)
})

formulario.addEventListener("submit", (e)=>{
    e.preventDefault();
})