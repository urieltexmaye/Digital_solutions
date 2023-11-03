function validateName(input) {
    //  conviérte a minúsculas
    let inputValue = input.value.toLowerCase();
    
    // Elimina  numeros y espacios adicionales
    inputValue = inputValue.replace(/[^\p{L}\sáéíóúÁÉÍÓÚ]/gu, '');

    
    // Limita la longitud 
    if (inputValue.length > 40) {
        inputValue = inputValue.substring(0, 40);
    }
    
    // Divide la cadena en palabras
    let words = inputValue.split(' ');
    
    // Capitaliza la primera letra de cada palabra
    for (let i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }
    
    // Une las palabras  en una sola cadena
    inputValue = words.join(' ');
    
    // Establece el valor validado en el campo de entrada
    input.value = inputValue;
}
function validateLastName(input) {
    let inputValue = input.value.toLowerCase();
    
    
    inputValue = inputValue.replace(/[^\p{L}\sáéíóúÁÉÍÓÚ]/gu, '');
    
    if (inputValue.length > 55) {
        inputValue = inputValue.substring(0, 55);
    }
    
    let words = inputValue.split(' ');
    
    for (let i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }
    
    inputValue = words.join(' ');
    
    input.value = inputValue;
}
function validateSearch(input) {
    let inputValue = input.value.toLowerCase();
    
    
    inputValue = inputValue.replace(/[^\p{L}\sáéíóúÁÉÍÓÚ]/gu, '');
    
    if (inputValue.length > 100) {
        inputValue = inputValue.substring(0, 100);
    }
    
    let words = inputValue.split(' ');
    
    for (let i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }
    
    inputValue = words.join(' ');
    
    input.value = inputValue;
}



document.addEventListener("DOMContentLoaded", function() {
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("email-error");

    let isFocused = false; // Bandera para verificar si  tiene el enfoque
    const minLengthForValidation = 3; // 

    emailInput.addEventListener("focus", function() {
        isFocused = true;
    });

    emailInput.addEventListener("blur", function() {
        isFocused = false;

        const emailValue = emailInput.value;
        const emailPattern = /^[a-zA-Z0-9._-]+@(gmail|hotmail)\.com$/;

        if (emailValue.length === 0) {
            // No se ha ingresado nada en el campo de correo electrónico, elimina el mensaje de error
            emailError.textContent = '';
        } else if (emailValue.length >= minLengthForValidation && emailPattern.test(emailValue)) {
            // El correo electrónico es válido, elimina el mensaje de error
            emailError.textContent = '';
        } else {
            // El correo electrónico no es válido, muestra un mensaje de error
            emailError.textContent = 'El correo electrónico no es válido.';
        }
    });
});





//quita los errores depues de no ser guardados en la BD
function limpiarError(elemento, errorElement) {
    errorElement.innerHTML = ''; 
}
    
function ocultarErrorEnFoco(elemento, errorElement) {
    errorElement.innerHTML = ''; 
}