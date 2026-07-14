// Función para mostrar una ventana de confirmación del navegador.
function confirmarImpresion(){
    return confirm("¿Quieres imprimir o guardar esta ficha?");
}

document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("formulario-contacto");

    if(formulario){
        formulario.addEventListener("submit", function(evento){
            const nombre = document.getElementById("nombre_cliente").value.trim();
            const email = document.getElementById("email").value.trim();
            const mensaje = document.getElementById("mensaje").value.trim();

            if(nombre === "" || email === "" || mensaje === ""){
                alert("Revisa el formulario: nombre, email y mensaje son obligatorios.");
                evento.preventDefault();
            }
        });
    }
});