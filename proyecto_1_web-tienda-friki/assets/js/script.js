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

document.addEventListener("DOMContentLoaded", function(){
    const slides = document.querySelectorAll(".slide");
    const btnAnterior = document.querySelector(".anterior");
    const btnSiguiente = document.querySelector(".siguiente");
    let actual = 0;

    function mostrarSlide(indice){
        slides.forEach(function(slide){
            slide.classList.remove("activo");
        });
        if(slides.length > 0){
            slides[indice].classList.add("activo");
        }
    }

    if(slides.length > 0){
        mostrarSlide(actual);
        if(btnSiguiente){
            btnSiguiente.addEventListener("click", function(){
                actual = (actual + 1) % slides.length;
                mostrarSlide(actual);
            })
        }

        if(btnAnterior){
            btnAnterior.addEventListener("click", function(){
                actual = (actual - 1 + slides.length) % slides.length;
                mostrarSlide(actual)
            })
        }

        setInterval(function(){
            actual = (actual + 1) % slides.length;
            mostrarSlide(actual);
        }, 5000)
    }
})