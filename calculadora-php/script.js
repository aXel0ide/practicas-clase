let calculadora_normal = document.getElementById("normal");
let calculadora_cientifica = document.getElementById("cientifica");
let operaciones_complejas = document.getElementById("operaciones-complejas");
let inputNum1 = document.getElementById("num1");
let inputNum2 = document.getElementById("num2");
let borrar = document.getElementById("borrar");

borrar.addEventListener("click", function(){
    inputNum1.value = "";
    inputNum2.value = "";
});

calculadora_cientifica.addEventListener("click", function(){
    operaciones_complejas.classList.remove("oculto");

    calculadora_normal.classList.remove("activo");
    calculadora_cientifica.classList.add("activo");
});

calculadora_normal.addEventListener("click", function(){
    operaciones_complejas.classList.add("oculto");

    calculadora_cientifica.classList.remove("activo");
    calculadora_normal.classList.add("activo");
});

document.getElementById("formularioCalculadora").addEventListener("submit", function(event){

    event.preventDefault();

    let num1 = document.getElementById("num1").value;
    let num2 = document.getElementById("num2").value;

    let boton = event.submitter; // botón que se ha pulsado
    let operacion = boton.value;

    if(num1 == ""){
        alert("Debes escribir el primer número.");
        event.preventDefault();
        return;
    }

    if(operacion !== "factorial" && num2 === ""){
        alert("Debes escribir el segundo número.");
        event.preventDefault();
        return;
    }

    if(operacion === "factorial" && (!Number.isInteger(Number(num1)) || Number(num1) < 0)){
        alert("El factorial solo admite números enteros no negativos.");
        event.preventDefault();
        return;
    }

});
