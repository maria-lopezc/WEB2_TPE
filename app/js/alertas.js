function showAlerta(idLibro){
    const alerta = document.getElementById('alertaBorrar' + idLibro);
    if (alerta) {
        alerta.classList.remove('oculto');
    }
}
function hideAlerta(idLibro){
    const alerta = document.getElementById('alertaBorrar' + idLibro);
    if (alerta) {
        alerta.classList.add('oculto');
    }
}