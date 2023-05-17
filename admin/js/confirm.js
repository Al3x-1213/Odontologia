document.querySelector(".login").addEventListener("click", (e)=>{
    if(confirm("Realmente quiere Cerrar Sesion?")){
        return true;
    }else{
        e.preventDefault();
    }
})

document.querySelectorAll(".volver").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere devolver a este paciente a la lista de no atendidos?")){
            return true
        }else{
            e.preventDefault()
    }})
})

document.querySelectorAll(".atendido").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere marcar a este paciente como ya atendido?")){
            return true
        }else{
            e.preventDefault()
    }})
})

document.querySelectorAll(".editar").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere editar el registro de este paciente?")){
            return true
        }else{
            e.preventDefault()
    }})
})

document.querySelectorAll(".eliminar").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere eliminar esta consulta?")){
            return true
        }else{
            e.preventDefault()
    }})
})