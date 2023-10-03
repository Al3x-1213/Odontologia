const formulario = document.querySelector(".form__recover");

const inputs = document.querySelectorAll('.grupo input');

function CharacterSpecials(str) {
    var regex = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\?]+/;
    return regex.test(str);
}

function CharacterUpper(str) {
    var regex = /[A-Z]/;
    return regex.test(str);
}

var clave = false, clave2 = false;

var claves = [];

const success = (grupo) => {
    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error1`).style.display = "none";
    document.querySelector(`#grupo_${grupo} .paragraf__error2`).style.display = "none";

    document.querySelector(`#grupo_${grupo} .icon-checkmark1`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("success");
}

const error = (grupo, error) => {
    document.querySelector(`#grupo_${grupo} .icon-checkmark1`).classList.add("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.remove("success");

    document.querySelector(`#grupo_${grupo} .icon-warning`).classList.remove("display");
    document.querySelector(`#grupo_${grupo} .input__form`).classList.add("error");
    document.querySelector(`#grupo_${grupo} .paragraf__error${error}`).style.display = "block";
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "clave":
            if (e.target.value.length < 8 || e.target.value.length > 35) {
                error(e.target.name, 1);
                clave = false;
            } else if (!CharacterUpper(e.target.value)) {
                document.querySelector(`#grupo_clave .paragraf__error1`).style.display = "none";
                error(e.target.name, 2);
                clave = false;
            } else if (!CharacterSpecials(e.target.value)) {
                document.querySelector(`#grupo_clave .paragraf__error1`).style.display = "none";
                error(e.target.name, 2);
                clave = false;
            } else {
                success(e.target.name);
                claves[0] = e.target.value;
                clave = true;
            }
            break;
        case "clave2":
            if (e.target.value.length >= 8 || e.target.value.length <= 35) {
                claves[1] = e.target.value;
                if (claves[0] != claves[1]) {
                    document.querySelector(`#grupo_clave .paragraf__error2`).style.display = "none";
                    error(e.target.name, 1);
                    clave2 = false;
                } else {
                    success(e.target.name);
                    clave2 = true;
                }
            } else {
                document.querySelector(`#grupo_clave .paragraf__error1`).style.display = "none";
                error(e.target.name, 2);
                clave2 = false;
            }
            break;
    };
}

inputs.forEach(input => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e) => {
    if (clave && clave2) {
        return true;
    } else {
        e.preventDefault();
    }
});