document.querySelectorAll(".atend").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere marcar a este paciente como ya atendido?")){
            return true
        }else{
            e.preventDefault()
    }})
})

document.querySelectorAll(".cancel").forEach(button=>{
    button.addEventListener("click", e=>{
        if(confirm("Realmente quiere eliminar esta consulta?")){
            return true
        }else{
            e.preventDefault()
    }})
})